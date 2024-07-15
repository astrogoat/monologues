<?php

namespace Astrogoat\Monologues\Providers;

use Astrogoat\Monologues\Http\Middleware\DatabaseAuth;
use Astrogoat\Monologues\Http\Middleware\HasDatabaseAccess;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->aliasMiddleware('has-database-access', HasDatabaseAccess::class);
        $this->aliasMiddleware('monologue-database-auth', DatabaseAuth::class);
    }
}
