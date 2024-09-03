<?php

namespace Astrogoat\Monologues\Services\Favorites;

use Illuminate\Support\Facades\DB;

class User
{
    public function __construct(protected \Helix\Lego\Models\User $user)
    {
        //
    }

    public function favorites(\Helix\Lego\Models\Model $model): void
    {
        DB::table('favorite_user')->insertOrIgnore([
            'favoriteable_type' => $model::class,
            'favoriteable_id' => $model->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function unfavorites(\Helix\Lego\Models\Model $model): void
    {
        DB::table('favorite_user')->where([
            'favoriteable_type' => $model::class,
            'favoriteable_id' => $model->id,
            'user_id' => $this->user->id,
        ])->delete();
    }

    public function toggle(\Helix\Lego\Models\Model $model): void
    {
        $this->hasFavorited($model)
            ? $this->unfavorites($model)
            : $this->favorites($model);
    }

    public function hasFavorited(\Helix\Lego\Models\Model $model): bool
    {
        return DB::table('favorite_user')->where([
            'favoriteable_type' => $model::class,
            'favoriteable_id' => $model->id,
            'user_id' => $this->user->id,
        ])->exists();
    }

    public function count(string $model): int
    {
        return DB::table('favorite_user')->where([
            'favoriteable_type' => $model,
            'user_id' => $this->user->id,
        ])->count();
    }
}
