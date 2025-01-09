<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfContainsOrganizations
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the URL contains 'organizations'
        if (str_contains($request->path(), 'organizations')) {
            
            // Get the slug from the query parameter
            $slug = $request->query('slug', 'default-slug'); // Default slug if not available

            // Prevent redirect if the current URL is already the target URL
            if ($request->is('lbsnaa-sub_org/organizations/*')) {
                return $next($request); // Continue with the request if already at the target
            }

            // Redirect to the correct route with the slug
            return redirect()->route('user.organizations', ['slug' => $slug]);
        }

        // If the condition is not met, continue with the request
        return $next($request);
    }
}

