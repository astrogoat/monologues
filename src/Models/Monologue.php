<?php

namespace Astrogoat\Monologues\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\User;
use Illuminate\Support\Str;
use Helix\Lego\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Astrogoat\Monologues\Enums\CharacterSex;
use Astrogoat\Monologues\Scopes\AccessScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrogoat\Monologues\Enums\MonologueLength;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ScopedBy([AccessScope::class])]
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

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function identities(): BelongsToMany
    {
        return $this->belongsToMany(Identity::class);
    }

    public function ages(): BelongsToMany
    {
        return $this->belongsToMany(Age::class);
    }

    public function genderIdentities(): BelongsToMany
    {
        return $this->belongsToMany(GenderIdentity::class);
    }

    public function scopeForUser(Builder $query, User|MonologueUser $user)
    {
        if ($user instanceof User) {
            $user = MonologueUser::wrap($user);
        }

        if ($user->user->hasRole('admin')) {
            return;
        }

        if (! $user->lastOrder) {
            $query->where('created_at', '>', now()->addDay()); // Trick to not show any monologues if they don't have an order.

            return;
        }

        $query->where('created_at', '<', $user->lastOrder->created_at);
    }

    public function getExcerptsFirstLineAttribute()
    {
        return Str::of($this->excerpt)
            ->replace(' lines]', ' line]')
            ->before('[Last line]')
            ->remove('[First line]')
            ->trim()
            ->toString();
    }

    public function getExcerptsLastLineAttribute()
    {
        return Str::of($this->excerpt)
            ->replace(' lines]', ' line]')
            ->after('[Last line] ')
            ->trim()
            ->toString();
    }

    public function getWordCountAttribute(): int
    {
        return str_word_count($this->text);
    }

    public function getCharacterCountAttribute(): int
    {
        return Str::length($this->text);
    }

    public function length(): MonologueLength
    {
        return MonologueLength::fromMonologue($this);
    }

    public function getShowRoute(array $parameters = []): string
    {
        return route('monologue-database.monologues.show', $this);
    }
}
