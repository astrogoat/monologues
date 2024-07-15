<?php

namespace Astrogoat\Monologues\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;

class DatabaseAuth extends Authenticate
{
    protected function redirectTo(Request $request): ?string
    {
        return route('register');
    }
}
