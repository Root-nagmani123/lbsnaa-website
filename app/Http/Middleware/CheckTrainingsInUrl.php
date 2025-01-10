<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTrainingsInUrl
{
    public function handle(Request $request, Closure $next)
    {
        // Get the full URL from the request
        $url = $request->fullUrl();
        $slug = $request->query('slug');  // Extract 'slug' query parameter

        // If the current URL is already /trainings, don't redirect again
        if ($request->is('lbsnaa-sub_tp/trainings/*')) {
            return $next($request);  // Continue processing the request without redirecting
        }

        // Check if the URL contains the word "trainings"
        if (strpos($url, 'trainings') !== false) {
            // If "trainings" is found in the URL, redirect to /trainings using the correct route name
            return redirect()->route('user.trainings', ['slug' => $slug]);
        }

        // Otherwise, continue with the request
        return $next($request);
    }
}
