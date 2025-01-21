<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// class RedirectIfTrainingProgram
// {
//     public function handle(Request $request, Closure $next)
//     {
//         // Check if 'training_program' is in the URL path
//         if (preg_match('/training[_\s\-]program/i', $request->path())) {

//             // Get the 'slug' query parameter
//             $slug = $request->query('slug'); 

//             // If the slug is missing, abort with an error
//             if (!$slug) {
//                 return abort(400, 'Missing slug parameter.');
//             }

//             // Avoid redirect loop by checking if we are already on the correct route
//             if ($request->route() && $request->route()->getName() === 'user.training_program') {
//                 return $next($request);  // Proceed to the next step if we're already on the correct route
//             }

        
//             return redirect()->route('user.training_program', ['slug' => $slug]);
//         }

//         return $next($request);
//     }
// }

class RedirectIfTrainingProgram
{
    public function handle(Request $request, Closure $next)
    {
        // Define a regex pattern to match relevant training-related keywords
        $pattern = '/(training[_\s\-]?program|training(s?)|workshop[_\s\-]?list)/i';

        // Check if the URL path matches the pattern
        if (preg_match($pattern, $request->path())) {

            // Get the 'slug' query parameter
            $slug = $request->query('slug');

            // If the slug is missing, abort with an error
            if (!$slug) {
                return abort(400, 'Missing slug parameter.');
            }

            // Avoid redirect loop by ensuring we are not already on the target route
            if ($request->route() && $request->route()->getName() === 'user.training_program') {
                return $next($request); // Proceed without redirection
            }

            // Redirect to the 'user.training_program' route with the slug
            return redirect()->route('user.training_program', ['slug' => $slug]);
        }

        // If no matching condition is found, proceed with the request
        return $next($request);
    }
}


