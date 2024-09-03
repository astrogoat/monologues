<?php

namespace Astrogoat\Monologues\Services\Favorites;

use Helix\Lego\Models\User;
use Helix\Lego\Models\Model;

class Favorites
{
    public static function user(User $user): \Astrogoat\Monologues\Services\Favorites\User
    {
        return new \Astrogoat\Monologues\Services\Favorites\User($user);
    }

    public static function model(Model $model): \Astrogoat\Monologues\Services\Favorites\Model
    {
        return new \Astrogoat\Monologues\Services\Favorites\Model($model);
    }
}
