<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && Auth::user()) {

                $role = Auth::user()->role; 

                switch ($role) {
                    case 'Root':
                        // Redirection
                        if (intval(Auth::user()->active) == 1) {
                            # code...
                            return redirect()->route('rootHome');
                        } else {
                            # code...
                            return redirect('/')->with('error', "Vous n'avez pas accès à cet espace.");
                        }
                        break;
                    default:
                        return redirect('/')->with('error', "Vous n'avez pas accès à cet espace.");
                        break;
                }
            }
        }

        return $next($request);
    }
}
