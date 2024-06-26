<?php

namespace Astrogoat\Monologues\Models;

use Astrogoat\Monologues\Enums\CharacterSex;
use Helix\Fabrick\Icon;
use Helix\Lego\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monologue extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'sex' => CharacterSex::class,
    ];

    public static function icon(): string
    {
        return Icon::BOOK_OPEN;
    }

    public function play()
    {
        return $this->belongsTo(Play::class);
    }
}
