<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Check if this is an API request or expects JSON
        if ($request->expectsJson()) {
            return null;
        }

        // Mark session as expired
        $request->session()->flash('auth_expired', true);

        // Check if the request is for admin routes
        if ($request->is('admin/*')) {
            return route('admin.login');
        }

        // For user routes or any other route, redirect to user login
        return route('user.auth.login', ['expired' => 1]);
    }
}
