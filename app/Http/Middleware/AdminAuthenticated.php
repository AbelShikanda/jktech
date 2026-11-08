<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin && ((int) ($admin->is_admin ?? 0) === 1 || method_exists($admin, 'hasAnyRole') && $admin->hasAnyRole(['super-admin', 'manager', 'viewer']))) {
            return $next($request);
        }

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        }

        return redirect()->route('getLogin')->with('error', 'Unauthorized admin access.');
    }
}
