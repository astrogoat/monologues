<?php

namespace Astrogoat\Monologues\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class MonologuesSettings extends AppSettings
{
    // public string $url; // Example, modify to fit your need.

    public function rules(): array
    {
        return [
//            'url' => Rule::requiredIf($this->enabled === true), // Example, modify to fit your need.
        ];
    }

    public function description(): string
    {
        return 'Interact with Monologues.';
    }

    public static function group(): string
    {
        return 'monologues';
    }
}
