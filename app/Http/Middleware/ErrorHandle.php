<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorHandle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, Exception $exception): Response
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return redirect()->route('yourWishedRoute');
        }

        return $next($request);
    }
}