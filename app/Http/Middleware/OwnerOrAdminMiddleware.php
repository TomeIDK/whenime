<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OwnerOrAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get username from route
        $username = $request->route('username');

        if(Auth::check()) {
            $user = Auth::user();

            // Check if auth'd user is owner of the profile or an admin
            if ($user->username === $username || $user->is_admin) {
                return $next($request);
            }
        }
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
