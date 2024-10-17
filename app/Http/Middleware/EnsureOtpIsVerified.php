<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureOtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('otp_verified')) {
            Auth::logout();
            return redirect()->route('user.login')->with('error', 'OTP verification required');
        }

        return $next($request);
    }
}
