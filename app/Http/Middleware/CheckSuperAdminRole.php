<?php

namespace App\Http\Middleware;

use App\Enums\AdminRoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
