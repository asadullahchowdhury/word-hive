<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken(); // from Authorization: Bearer <token>

        if ($token && $token === cache('admin_token')) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
