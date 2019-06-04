<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Services\UserService;

class RegisterController extends Controller
{

    /**
     * register 
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {   
        $user = UserService::register( $request->validated());
        $user->token = $user->createToken('safe-wallet');
        return new LoginResource($user);
    }
    
}
