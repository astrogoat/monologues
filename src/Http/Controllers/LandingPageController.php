<?php

namespace Astrogoat\Monologues\Http\Controllers;

use Astrogoat\Monologues\Settings\MonologuesSettings;

class LandingPageController
{
    public function __invoke()
    {
        return 'Super fancy landing pages. <a href="' . route('monologues.checkout', app(MonologuesSettings::class)->primary_price_id) . '">Checkout</a>';
    }
}
