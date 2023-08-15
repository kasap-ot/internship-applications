<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userLoggedIn = auth()->check();
        if (!$userLoggedIn)
            return $next($request);
        
        $userNotVerified = !auth()->user()->verified;
        $userNotAdmin = auth()->user()->userable_type != 'admin';
        
        if ($userLoggedIn && $userNotVerified && $userNotAdmin) {
            auth()->logout();
            return redirect()
                ->route('login')
                ->with('message', 'Please wait for registration request approval.');
        }

        return $next($request);
    }
}
