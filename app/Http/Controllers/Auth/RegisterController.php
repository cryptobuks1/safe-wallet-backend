<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\User;

class RegisterController extends Controller
{

    /**
     * register 
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {   
        $value = $request->validated();
        $user = User::create( [
            'name' => $value['name'],
            'email' => $value['email'],
            'password' => Hash::make($value['password'])
        ]);
        $user->token = $user->createToken('safe-wallet');
        return new LoginResource($user);
    }
    
}
