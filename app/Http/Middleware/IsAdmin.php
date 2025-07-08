<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if user isn't logged in OR user isn't admin, filters back with a redirection
        if (Auth::user()->type !== "admin") {
            return redirect()->back()->with('error', 'access denied (admin only)');
        }

        // else, proceeds with next request ($next)
        return $next($request);
    }
}
