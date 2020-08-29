<?php

namespace App\Http\Middleware;

use Closure;

class ResetTokenVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if($user->reset_token) {
            return response()->json([
               'error' => 'Invalid'
            ]);
        }

        return $next($request);
    }
}
