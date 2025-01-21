<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// class CheckTrainingsInUrl
// {
//     public function handle(Request $request, Closure $next)
//     {
//         // Get the full URL from the request
//         $url = $request->fullUrl();
//         $slug = $request->query('slug');  // Extract 'slug' query parameter

//         // If the current URL is already /trainings, don't redirect again
//         if ($request->is('lbsnaa-sub_tp/trainings/*')) {
//             return $next($request);  // Continue processing the request without redirecting
//         }

//         // Check if the URL contains the word "trainings"
//         if (strpos($url, 'trainings') !== false) {
//             // If "trainings" is found in the URL, redirect to /trainings using the correct route name
//             return redirect()->route('user.trainings', ['slug' => $slug]);
//         }

//         // Otherwise, continue with the request
//         return $next($request);
//     }
// }

class CheckTrainingsInUrl
{
    public function handle(Request $request, Closure $next)
    {
        // Define a regex pattern to match training-related keywords
        $pattern = '/(training[_\s\-]?program|training(s?)|workshop[_\s\-]?list)/i';

        // Get the full URL and 'slug' query parameter
        $url = $request->fullUrl();
        $slug = $request->query('slug'); // Extract 'slug' query parameter

        // If the current URL is already /trainings, don't redirect again
        if ($request->is('lbsnaa-sub_tp/trainings/*')) {
            return $next($request); // Continue processing the request without redirecting
        }

        // Check if the URL matches the regex pattern
        if (preg_match($pattern, $request->path())) {
            // If the slug is missing, abort with a 400 error
            if (!$slug) {
                return abort(400, 'Missing slug parameter.');
            }

            // Redirect to the 'user.trainings' route with the slug
            return redirect()->route('user.trainings', ['slug' => $slug]);
        }

        // If no match is found, continue with the request
        return $next($request);
    }
}

