<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

use App\User;
USE App\Balance;

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
     * register a user 
     * @param $valuews { }
     */
    public static function register( $value)
    {
        try
        {
            DB::beginTransaction();
            $value['password'] = Hash::make($value['password']);
            $user = User::create( Arr::only( $value, [ 'name', 'email', 'password']));
            Balance::create([ 
                'user_id' => $user->id,
                'balance' => 100.0  
            ]);
            DB::commit();
            return $user;
        }
        catch( Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
    }


    
}