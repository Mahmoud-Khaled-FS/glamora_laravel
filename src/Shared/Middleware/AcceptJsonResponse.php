<?php

namespace Src\Shared\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcceptJsonResponse
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $acceptHeader = $request->header("Accept");
        if (!$acceptHeader || $acceptHeader === '*/*') {
            $request->headers->set("Accept", "application/json");
        }
        return $next($request);
    }
}
