<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only(['email', 'password']);

        $token = auth()->attempt($credentials);

        if ($token) {
            return response()->json([
                'token' => $token,
                'success' => true,
            ]);
        }

        return response()->json([
            'error' => 'unauthorized',
        ], 401);
    }
}
