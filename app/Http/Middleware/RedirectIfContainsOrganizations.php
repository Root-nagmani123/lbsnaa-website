<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// class RedirectIfContainsOrganizations
// {
//     public function handle(Request $request, Closure $next)
//     {
//         // Use a regex to check if the URL contains any of the related terms
//         if (preg_match('/organization(s?|_setup)/', $request->path())) {

//             // Get the slug from the query parameter
//             $slug = $request->query('slug', 'default-slug'); // Default slug if not available

//             // Prevent redirect if the current URL is already the target URL
//             if ($request->is('lbsnaa-sub_org/organizations/*')) {
//                 return $next($request); // Continue with the request if already at the target
//             }

//             // Redirect to the correct route with the slug
//             return redirect()->route('user.organizations', ['slug' => $slug]);
//         }

//         // If the condition is not met, continue with the request
//         return $next($request);
//     }
// }


class RedirectIfContainsOrganizations
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the URL contains "organizations" but not in the specific format
        if (preg_match('/organization(s?|_setup)/', $request->path())) {

            // If the URL is of type 1, do not redirect, continue as is
            if ($request->is('menu/organization')) {
                return $next($request);
            }

            // If the URL is of type 2, ensure redirection logic works correctly
            if ($request->is('lbsnaa-subs/micromenu/organizations')) {
                $slug = $request->query('slug', 'default-slug'); // Default slug if not available

                // Redirect to the correct route with the slug
                return redirect()->route('user.organizations', ['slug' => $slug]);
            }
        }

        // If the condition is not met, continue with the request
        return $next($request);
    }
}



