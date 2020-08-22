<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $ttl_remember_minutes = 4320;

    protected $ttl_default_minutes = 60;

    function login(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
            'remember' => 'nullable|boolean',
        ]);

        $credentials = $request->only(['email', 'password']);
        $remember = $request->input('remember');

        $token = auth()->setTTL($this->getTTL($remember))->attempt($credentials);

        if ($token) {
            return response()->json([
                'token' => $token,
                'success' => true,
            ]);
        }

        return response()->json([
           'error' => 'Unauthorized',
        ], 401);
    }

    private function getTTL($remember) {
        return $remember ? $this->ttl_default_minutes : $this->ttl_default_minutes;
    }

    function logout() {
        auth()->logout();

        return response([], 204);
    }
}
