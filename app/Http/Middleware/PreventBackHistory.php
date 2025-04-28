<?php
namespace App\Http\Middleware; 

use Closure;
use Illuminate\Http\Request;

class PreventBackHistory {
    public function handle(Request $request, Closure $next)
    {
        // Get the response from the next middleware or controller
        $response = $next($request);

        // Check if the response is not a BinaryFileResponse
        if (!method_exists($response, 'headers')) {
            return $response;
        }

        // Add headers using $response->headers->set()
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');

        return $response;
    }
}

