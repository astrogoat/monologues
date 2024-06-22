<?php

namespace Astrogoat\Monologues\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Astrogoat\Monologues\Enums\TheatricalType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Play extends Model
{
    use SoftDeletes;
    use HasSlug;

    protected $casts = [
        'type' => TheatricalType::class,
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function monologues(): HasMany
    {
        return $this->hasMany(Monologue::class);
    }

    public static function icon(): string
    {
        return Icon::BOOK_OPEN;
    }

    public function getDisplayKeyName(): string
    {
        return 'title';
    }

    public function getEditRoute(): string
    {
        return route('lego.monologues.plays.edit', $this);
    }
}
