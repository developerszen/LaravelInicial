<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $auth = auth()->attempt($credentials);

        if($auth) {
            $token = User::firstWhere('email', $request->input('email'))->createToken('access_token');

            return response([
                'access_token' => $token->plainTextToken,
            ]);
        }

        return response([
           'error' => 'Unauthenticated',
        ]);
    }

    function logout() {
        auth()->user()->tokens()->delete();

        return response(null, 204);
    }

    function me() {
        return auth()->user();
    }
}
