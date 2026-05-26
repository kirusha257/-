<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminAuthController;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!AdminAuthController::isLoggedIn()) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}