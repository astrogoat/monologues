<?php

namespace Astrogoat\Monologues\Enums;

enum Permission: string
{
    case ACCESS_MONOLOGUE_DATABASE = 'access monologue database';

    public function check(): string
    {
        return 'monologues_' . $this->value;
    }
}
