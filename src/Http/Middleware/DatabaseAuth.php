<?php

namespace Astrogoat\Monologues\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class DatabaseAuth extends Authenticate
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->routeIs('monologue-database.checkout') && $request->route()->hasParameter('price')) {
            session()->put('sign-up-price', $request->route()->parameter('price'));
        }

        return route('register');
    }
}
