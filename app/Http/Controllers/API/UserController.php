<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    // function register() {}

    function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('accessToken');
            return [
                'user' => $user,
                'token' => $token->plainTextToken
                ];
        }
 
        return response()->json(array(
            'code'      =>  401,
            'message'   =>  "email or password not valid"
        ), 401);
        
    }

    function logout(Request $request)  {
        $hashedToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($hashedToken);
        $user = $token->tokenable;
        $user->tokens()->delete();
       

       return ["message"  => "user logged out",
    ];
    }
}
