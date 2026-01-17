<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $response = $next($request);
        // return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
        //                 ->header('Pragma','no-cache')
        //                 ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
        $response = $next($request);

    // Skip cache headers for file downloads
    if (!$response instanceof BinaryFileResponse && !$response instanceof StreamedResponse) {
        $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }

    return $response;
    }
}
