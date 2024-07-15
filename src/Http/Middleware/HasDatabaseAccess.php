<?php

namespace Astrogoat\Monologues\Http\Middleware;

use Astrogoat\Monologues\Models\MonologueUser;
use Closure;
use Illuminate\Http\Request;

class HasDatabaseAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (! ($user = $request->user())) {
            return redirect()->route('register');
        }

        if (! MonologueUser::wrap($user)->hasDatabaseAccess()) {
            return redirect()->route('monologues.landing-page');
        }

        return $next($request);
    }
}
