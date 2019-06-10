<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

use App\User;
USE App\Balance;
use App\Transfer;
use App\Transaction;

use PHPUnit\Framework\Exception;

class TranferService 
{
    /**
     * get all transactions
     */
    public static function all( &$user_id)
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
    public static function register( $value, $user_id)
    {
        try
        {
            $code = $value['code'];
            $amount = $value['amount'];
            $commentary = $value['commentary']; 
            $user = User::find( $user_id);
            $userDes = User::where('code', $value['code'])->firstOrFail();

            DB::beginTransaction();

            $balance = $user->balance()->whereRaw('balance - ? >= 0 ', [ $amount])->sharedLock()->first();

            $destination = Transaction::create([
                'user_id' => $userDes->id,
                'detail' => 'transfer received, ',
                'type' => 'transfer',
                'status' => 'pending',
                'amount' => $amount,
            ]);
            
            $source = Transaction::create([
                'user_id' => $user->id ,
                'detail' => 'successful transfer',
                'type' => 'transfer',
                'status' => 'pending',
                'amount' =>  - $amount,
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
        }
        catch( Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

    }

}
