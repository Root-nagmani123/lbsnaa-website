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

// class CheckTrainingsInUrl
// {
//     public function handle(Request $request, Closure $next)
//     {
//         // Define a regex pattern to match training-related keywords
//         $pattern = '/(training[_\s\-]?program|training(s?)|workshop[_\s\-]?list)/i';

//         // Get the full URL and 'slug' query parameter
//         $url = $request->fullUrl();
//         $slug = $request->query('slug'); // Extract 'slug' query parameter

//         // If the current URL is already /trainings, don't redirect again
//         if ($request->is('lbsnaa-sub_tp/trainings/*')) {
//             return $next($request); // Continue processing the request without redirecting
//         }

//         // Check if the URL matches the regex pattern
//         if (preg_match($pattern, $request->path())) {
//             // If the slug is missing, abort with a 400 error
//             if (!$slug) {
//                 return abort(400, 'Missing slug parameter.');
//             }

//             // Redirect to the 'user.trainings' route with the slug
//             return redirect()->route('user.trainings', ['slug' => $slug]);
//         }

//         // If no match is found, continue with the request
//         return $next($request);
//     }
// }

// class CheckTrainingsInUrl
// {
//     public function handle(Request $request, Closure $next)
//     {
//         // Define a regex pattern to match only "Training Program" and "workshop list"
//         $pattern = '/(training[_\s\-]?program|workshop[_\s\-]?list)/i';

//         // Get the full URL and 'slug' query parameter
//         $url = $request->fullUrl();
//         $slug = $request->query('slug'); // Extract 'slug' query parameter

//         // Exclude admin URLs and course listing URLs from processing
//         if ($request->is('admin/*') || $request->is('course_listing/*')) {
//             return $next($request); // Skip middleware for admin or course listing URLs
//         }

//         // If the current URL is already /trainings, don't redirect again
//         if ($request->is('lbsnaa-sub_tp/trainings/*')) {
//             return $next($request); // Continue processing the request without redirecting
//         }

//         // Check if the URL matches the regex pattern
//         if (preg_match($pattern, $request->path())) {
//             // If the slug is missing, abort with a 400 error
//             if (!$slug) {
//                 return abort(400, 'Missing slug parameter.');
//             }

//             // Redirect to the 'user.trainings' route with the slug
//             return redirect()->route('user.trainings', ['slug' => $slug]);
//         }

//         // If no match is found, continue with the request
//         return $next($request);
//     }
// }

class CheckTrainingsInUrl
{
    public function handle(Request $request, Closure $next)
    {
        // Define allowed paths for redirection
        $allowedPaths = ['workshop-list', 'training-program'];

        // Get the current path (excluding the domain)
        $currentPath = $request->path();

        // Check if the current path contains any of the allowed paths
        $matchesAllowedPath = false;
        foreach ($allowedPaths as $allowedPath) {
            if (strpos($currentPath, $allowedPath) !== false) {
                // Ensure the allowed path matches the URL segment fully
                $matchesAllowedPath = true;
                break;
            }
        }

        // If no match is found for the allowed paths, continue without redirection
        if (!$matchesAllowedPath) {
            // If URL doesn't match, just proceed
            return $next($request);
        }

        // Now, check if the 'slug' query parameter is present only for valid paths
        $slug = $request->query('slug');

        // If there's no slug, it might not be needed for this path, so skip
        if (empty($slug)) {
            // If the slug is missing, and we're processing a valid path, we can allow it.
            // Adjust behavior based on the actual URL needs.
            // If you don't want to return an error here, we can just proceed as normal.
            return $next($request);
        }

        // Otherwise, perform the redirection if slug exists
        return redirect()->route('user.trainings', ['slug' => $slug]);
    }
}





