<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RouteNeedsRole
{
    public function handle(Request $request, Closure $next, $role, $needsAll = false)
    {
        if (str_contains($role, ';')) {
            $roles = explode(';', $role);
            $access = access()->hasRoles($roles, $needsAll === 'true');
        } else {
            /**
             * Single role.
             */
            $access = access()->hasRole($role);
        }

        if (! $access) {
            return redirect()
                ->route('frontend.index')
                ->withFlashDanger(trans('auth.general_error'));
        }

        return $next($request);
    }
}
