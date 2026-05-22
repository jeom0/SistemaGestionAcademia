<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Check if user is active
        if (!$user->isActive()) {
            Auth::logout();
            return redirect('/login')
                ->withErrors(['email' => 'Tu cuenta está inactiva. Contacta al administrador.']);
        }

        // Root has access to everything
        if ($user->isRoot()) {
            return $next($request);
        }

        // Split roles if multiple are provided (e.g., 'administrator,collaborator')
        $roleArray = explode(',', $roles);

        if (in_array($user->role, $roleArray)) {
            return $next($request);
        }

        // Special handling for legacy names if needed, but 'root' is already handled
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
}
