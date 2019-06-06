<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

use App\User;
USE App\Balance;
use App\Transfer;

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

            $user = User::find( $user_id);
            $userDes = User::where('code', $value['code'])->findOrFail();

            DB::beginTransaction();

            $balance = $user->balance()->whereRaw("balance - ? >= 0 ", [ $amount])->sharedLock()->first();

            Transfer::create([

            ]);

            DB::commit();
            return $user_id;
        }
        catch( Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

    }

}
