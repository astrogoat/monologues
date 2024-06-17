<?php

namespace Astrogoat\Monologues;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Monologues\Monologues
 */
class MonologuesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'monologues';
    }
}
