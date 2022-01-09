<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($role == 'Admin' && auth()->user()->tipe_user != "Admin") {
            abort(403);
        }

        if ($role == 'PBJ' && auth()->user()->tipe_user != "PBJ") {
            abort(403);
        }

        if ($role == 'Pengusul' && auth()->user()->tipe_user != "Pengusul") {
            abort(403);
        }

        if ($role == 'Validator' && auth()->user()->tipe_user != "Validator") {
            abort(403);
        }

        return $next($request);
    }
}
