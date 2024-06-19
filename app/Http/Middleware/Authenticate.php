<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Auth\Middleware\Authenticate as Middleware;
// use Illuminate\Support\Facades\Auth;

// class Authenticate extends Middleware
// {
//     protected function redirectTo($request)
//     {
//         if (! $request->expectsJson()) {
//             return route('login');
//         }
//     }

//     public function handle($request, Closure $next, ...$guards)
//     {
//         if (Auth::guard($guards)->guest()) {
//             if ($request->is('api/*') || $request->ajax() || $request->wantsJson()) {
//                 return response('Unauthorized.', 401);
//             }

//             return redirect()->guest('admin/login');
//         }
//         $this->authenticate($request, $guards);

//         return $next($request);
//     }
// }

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::shouldUse($guard);
                return;
            }
        }

        $this->unauthenticated($request, $guards);
    }

    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            abort(response()->json(['message' => 'Unauthenticated.'], 401));
        }

        return redirect()->guest(route('login'));
    }
}
