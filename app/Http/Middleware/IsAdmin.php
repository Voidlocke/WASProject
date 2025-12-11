<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check both Laravel auth guard AND manual session
        $isAuthenticatedViaGuard = auth()->guard('admin')->check();
        $isAuthenticatedViaSession = $request->session()->get('admin_authenticated', false);

        // Debug logging
        \Log::info('IsAdmin middleware check', [
            'url' => $request->url(),
            'guard_authenticated' => $isAuthenticatedViaGuard,
            'session_authenticated' => $isAuthenticatedViaSession,
            'admin_id_guard' => auth()->guard('admin')->id(),
            'admin_id_session' => $request->session()->get('admin_id'),
            'session_id' => $request->session()->getId(),
        ]);

        // Check if user is authenticated (either via guard OR session)
        if (!$isAuthenticatedViaGuard && !$isAuthenticatedViaSession) {
            // Redirect to admin login if not authenticated
            \Log::warning('IsAdmin middleware: Not authenticated, redirecting to login');
            return redirect()->route('admin.login')->with('error', 'Please login as admin to access this page.');
        }

        \Log::info('IsAdmin middleware: Authenticated, allowing access');
        return $next($request);
    }
}
