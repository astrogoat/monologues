<?php

namespace Astrogoat\Monologues\Models;

use Astrogoat\Monologues\Enums\TheatricalType;
use Helix\Fabrick\Icon;
use Helix\Lego\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Play extends Model
{
    use SoftDeletes;
    use HasSlug;

    protected $casts = [
        'type' => TheatricalType::class,
    ];

    public function getSlugOptions(): SlugOptions
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

    public function playTypes(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function playSources(): BelongsToMany
    {
        return $this->belongsToMany(PlaySource::class)->withPivot('url');
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
