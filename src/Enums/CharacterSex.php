<?php

namespace Astrogoat\Monologues\Enums;

/** @deprecated  */
enum CharacterSex: string
{
    case M = 'M';
    case F = 'F';

    public function fullName()
    {
        return match ($this) {
            self::M => 'Male',
            self::F => 'Female',
        };
    }
}
