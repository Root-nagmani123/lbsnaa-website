<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SingleSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = session()->getId();

            // ✅ Check karein ki user ka ek aur session active hai
            $existingSession = DB::table('sessions')
                ->where('user_id', $user->id)
                ->where('id', '!=', $currentSessionId)
                ->first();

            if ($existingSession) {
                // ✅ Pehle ka session delete karein
                DB::table('sessions')->where('user_id', $user->id)->delete();

                // ✅ User ko logout karein
                Auth::logout();
                return redirect('/login')->withErrors(['message' => 'You have been logged out due to login from another device.']);
            }
        }

        return $next($request);
    }
}
