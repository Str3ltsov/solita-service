<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check())
            return redirect('login')->with('error', __('messages.errorAuthCheck'));

        $user = Auth::user();

        if (in_array($user->role->name, $roles, true)) {
            $request->prefix = strtolower($user->role->name);
            return $next($request);
        }

        return back()->with('error', __('messages.errorUnauthAccess'));
    }
}
