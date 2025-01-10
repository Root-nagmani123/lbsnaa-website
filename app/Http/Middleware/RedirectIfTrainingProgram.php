<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfTrainingProgram
{
    public function handle(Request $request, Closure $next)
    {
        // Check if 'training_program' is in the URL path
        if (preg_match('/training[_\s\-]program/i', $request->path())) {

            // Get the 'slug' query parameter
            $slug = $request->query('slug');

            // If the slug is missing, abort with an error
            if (!$slug) {
                return abort(400, 'Missing slug parameter.');
            }

            // Avoid redirect loop by checking if we are already on the correct route
            if ($request->route() && $request->route()->getName() === 'user.training_program') {
                return $next($request);  // Proceed to the next step if we're already on the correct route
            }

            // Redirect to the 'user.organizations' route with the query parameter 'slug'
            return redirect()->route('user.training_program', ['slug' => $slug]);
        }

        return $next($request);
    }
}

