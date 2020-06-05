<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    function login(Request $request) {
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
        $token = JWTAuth::attempt($credentials);

        if(!$token) {
            return response()->json([
                'error' => 'Unauthorized'
            ]);
        }

        return response()->json([
            'token' => $token
        ]);
    }
}
