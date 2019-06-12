<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Balance;
use App\Transfer;
use App\Transaction;

use App\Exceptions\InsufficientFoundException;

use PHPUnit\Framework\Exception;

class TranferService
{
    /**
     * get all transactions
     */
    public static function all(&$user_id)
    {
        return Transfer::with('transaction')
            ->where('user_id', $user_id)
            ->paginate();
    }

    /**
     * register a transference 
     * @param $value [ code, amount]
     * @param $user_id
     * @return transaction 
     */
    public static function register($value, $user_id)
    {
        try {
            $code = $value['code'];
            $amount = $value['amount'];
            $commentary = $value['commentary'];
            $user = User::find($user_id);
            $userDes = User::where('code', $value['code'])->firstOrFail();

            DB::beginTransaction();

            $balance = $user->balance()->whereRaw('balance - ? >= 0 ', [$amount])->sharedLock()->first();
            if (is_null($balance)) {
                throw new InsufficientFoundException(' Error');
            }

            $destination = Transaction::create([
                'user_id' => $userDes->id,
                'detail' => 'transfer received, ',
                'type' => 'transfer',
                'status' => 'pending',
                'amount' => $amount,
            ]);

            $source = Transaction::create([
                'user_id' => $user->id,
                'detail' => 'successful transfer',
                'type' => 'transfer',
                'status' => 'pending',
                'amount' =>  -$amount,
            ]);

            $transfer = Transfer::create([
                'commentary' => $commentary,
                'user_id' => $user->id,
                'beneficiary_id'  => $userDes->id,
                'source_id' => $source->id,
                'destination_id' => $destination->id,
            ]);

            DB::commit();
            return $transfer;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * process a transference 
     * @param $value [ code, amount]
     * @param $user_id
     * @return transaction 
     */
    public static function process($transfer_id)
    {
        try {
            $transfer = Transfer::with(['user', 'beneficiary', 'source', 'destination'])->findOrFail($transfer_id);

            if ($transfer->source->status != 'pending') {
                return $transfer;
            }

            DB::beginTransaction();
            $balanceSource = $transfer->user->balance()->sharedLock()->first();
            $balanceDestionation = $transfer->beneficiary->balance()->sharedLock()->first();

            if ($balanceSource->balance >= -$transfer->source->amount) {
                $balanceSource->update([
                    'balance' => $balanceSource->balance + $transfer->source->amount
                ]);

                $balanceDestionation->update([
                    'balance' => $balanceDestionation->balance + $transfer->destination->amount
                ]);

                $transfer->source->update([
                    'status' => 'accepted'
                ]);

                $transfer->destination->update([
                    'status' => 'accepted'
                ]);
            } else {
                $transfer->source->update([
                    'status' => 'rejected'
                ]);

                $transfer->destination->update([
                    'status' => 'rejected'
                ]);
            }

            DB::commit();
            return $transfer;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
