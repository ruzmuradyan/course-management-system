<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info("Log Requests", [
            'url'=>$request->fullUrl(),
            'method'=>$request->method(),
            'request' => $request->all()
        ]);

        $response = $next($request);

        Log::info('Response', [
            'status'=>$response->status(),
            'content'=>$response->getContent()
        ]);
        return $response;
    }
}
