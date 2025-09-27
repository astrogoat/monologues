<?php

namespace Astrogoat\Monologues\Enums;

enum Role: string
{
    case CUSTOMER = 'monologues_customer';
    case PROMOTIONAL = 'monologues_promotional';

    public function check(): string
    {
        return 'monologues_' . $this->value;
    }

    public function assign(): string
    {
        return 'monologues_' . $this->value;
    }
}
