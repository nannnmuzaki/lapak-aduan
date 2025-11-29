<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RestrictPanelAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        $panelId = filament()->getId();
        $isIgnoredRoute = $request->routeIs([
            "filament.{$panelId}.auth.email-verification.prompt", // Halaman "Check inbox"
            "filament.{$panelId}.auth.email-verification.verify", // Link verifikasi
            "filament.{$panelId}.auth.logout", // Logout
        ]);

        if ($isIgnoredRoute) {
            return $next($request);
        }

        if ($user->hasRole('user')) {
            return redirect('/');
        }

        return $next($request);
    }
}