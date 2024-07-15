<?php

namespace Astrogoat\Monologues\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\User;
use Helix\Lego\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Astrogoat\Monologues\Enums\CharacterSex;
use Astrogoat\Monologues\Scopes\AccessScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

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

    public function scopeForUser(Builder $query, User|MonologueUser $user)
    {
        if ($user instanceof User) {
            $user = MonologueUser::wrap($user);
        }

//        dd($this, $this->created_at, $user->lastOrder);

        $query->where('created_at', '<', $user->lastOrder->created_at);
    }
}
