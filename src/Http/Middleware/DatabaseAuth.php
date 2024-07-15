<?php

namespace Astrogoat\Monologues\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class DatabaseAuth extends Authenticate
{
    protected function redirectTo(Request $request): ?string
    {
        return route('register');
    }
}
