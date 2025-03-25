<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StorePreviousUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!isset($_COOKIE['language'])) {
            $defaultLang = '1'; // Default: English
            setcookie('language', $defaultLang, time() + (86400 * 30), "/"); // 30 Days Valid
            session(['language' => $defaultLang]);
            session()->save();
            $_COOKIE['language'] = $defaultLang; 
        
        } 
        
        if ($request->method() === 'GET' && !$request->ajax()) {
            session(['url.previousdata' => url()->full()]);
        }
     
        return $next($request);
    }
}
