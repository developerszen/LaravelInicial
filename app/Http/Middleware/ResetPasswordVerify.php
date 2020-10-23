<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResetPasswordVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user->reset_token) {
            return response([
                'error' => 'Password recovery no verified'
            ]);
        }

        return $next($request);
    }
}
