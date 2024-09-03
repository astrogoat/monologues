<?php

namespace Astrogoat\Monologues\Services\Favorites;

use Illuminate\Support\Facades\DB;

class Model
{
    public function __construct(protected \Helix\Lego\Models\Model $model)
    {
        //
    }

    public function favoritedBy(\Helix\Lego\Models\User $user)
    {
        DB::table('favorite_user')->insertOrIgnore([
            'favoriteable_type' => $this->model::class,
            'favoriteable_id' => $this->model->id,
            'user_id' => $user->id,
        ]);
    }

    public function unfavoritedBy(\Helix\Lego\Models\User $user)
    {
        DB::table('favorite_user')->where([
            'favoriteable_type' => $this->model::class,
            'favoriteable_id' => $this->model->id,
            'user_id' => $user->id,
        ])->delete();
    }

    public function count()
    {
        return DB::table('favorite_user')->where([
            'favoriteable_type' => $this->model::class,
            'favoriteable_id' => $this->model->id,
        ])->count();
    }
}
