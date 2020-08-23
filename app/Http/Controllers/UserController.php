<?php

namespace App\Http\Controllers;

use App\Mail\EmailRecovery;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function requestPasswordRecovery(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->input('email');

        $reset_token = $this->generateToken();

        $user = User::where('email', $email)->firstOrFail();

        $user->update([
           'reset_token' => $reset_token,
        ]);

        Mail::to($email)->send(new EmailRecovery($user));

        return response([], 204);

    }

    private function generateToken() {
        $token = Str::random(80);

        $token_exists = User::where('reset_token', $token)->exists();

        if($token_exists) {
            $this->generateToken();
        }

        return $token;
    }
}
