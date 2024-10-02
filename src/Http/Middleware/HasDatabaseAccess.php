<?php

namespace Astrogoat\Monologues\Http\Middleware;

use Astrogoat\Monologues\Models\MonologueUser;
use Closure;
use Illuminate\Http\Request;
use Astrogoat\Monologues\Settings\MonologuesSettings;

class HasDatabaseAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (! ($user = $request->user())) {
            return redirect()->route('register');
        }

        if (! MonologueUser::wrap($user)->hasDatabaseAccess()) {
            $settings = resolve(MonologuesSettings::class);

            return redirect(route('monologue-database.checkout', resolve(MonologuesSettings::class)->primary_price_id));
        }

        return $next($request);
    }
}
