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
            if (session()->has('sign-up-price')) {
                return redirect(route('monologue-database.checkout', ['price' => session()->get('sign-up-price')]));
            }

            return redirect(app(MonologuesSettings::class)->getPricingPageModel()->getShowRoute());
        }

        return $next($request);
    }
}
