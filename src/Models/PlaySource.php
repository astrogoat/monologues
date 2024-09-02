<?php

namespace Astrogoat\Monologues\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlaySource extends Model
{
    protected $guarded = [];

    public function plays(): BelongsToMany
    {
        return $this->belongsToMany(Play::class);
    }
}
