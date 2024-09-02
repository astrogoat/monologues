<?php

namespace Astrogoat\Monologues\Enums;

use Astrogoat\Monologues\Models\Monologue;

enum MonologueLength: string
{
    case SHORT = 'Short';
    case MEDIUM = 'Medium';
    case LONG = 'Long';

    public static function fromMonologue(Monologue $monologue): MonologueLength
    {
        $wordCount = $monologue->wordCount;

        if ($wordCount <= 200) {
            return MonologueLength::SHORT;
        } elseif ($wordCount <= 400) {
            return MonologueLength::MEDIUM;
        } else {
            return MonologueLength::LONG;
        }
    }

    public function progressBarWidth(): int
    {
        return match ($this) {
            self::SHORT => 33,
            self::MEDIUM => 66,
            self::LONG => 100,

        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SHORT => 'blue',
            self::MEDIUM => 'indigo',
            self::LONG => 'purple',

        };
    }
}
