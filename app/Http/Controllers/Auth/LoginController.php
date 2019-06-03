<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Authenticate;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\LoginResource;

class LoginController extends Controller
{

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AuthRequest $request)
    {   
        $values = $request->validated();
        if((Authenticate::attempt( $values)))
        {
            $user = Authenticate::user();
            $user->token = $user->createToken('safe-wallet');
            return new LoginResource($user);
        }
        else
        {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if(Authenticate::user())
        {
           Authenticate::user()->token()->revoke();
        }
        else
        {
            return response()->json([], 404);
        }
    }
}
