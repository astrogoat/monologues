<?php

namespace Astrogoat\Monologues\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Age extends Model
{
    protected $guarded = [];

    public function monologues(): BelongsToMany
    {
        return $this->belongsToMany(Monologue::class);
    }
}
