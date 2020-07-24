<?php

namespace App\Http\Controllers;

use App\Mail\VerifiedEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string'
        ]);

        $record = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'email_verified_token' => $this->generateToken(),
        ]);

        Mail::to($record->email)->send(new VerifiedEmail($record));

        return $record;
    }

    function verify(Request $request) {
        $user = User::where('email_verified_token', $request->query('email_verified_token'))->firstOrFail();

        $user->update([
            'email_verified_at' => now(),
            'email_verified_token' => null,
        ]);

        return response([
            'success' => 'Email verified'
        ]);
    }

    protected function generateToken() {
        $token = Str::random(80);

        $token_exists = User::where('email_verified_token', $token)->exists();

        if ($token_exists) {
            $this->generateToken();
        }

        return $token;
    }
}
