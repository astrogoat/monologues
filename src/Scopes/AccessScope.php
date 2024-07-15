<?php

namespace Astrogoat\Monologues\Scopes;

use Astrogoat\Monologues\Models\MonologueUser;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AccessScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (! auth()->check()) {
            return $builder->where('id', false);
        }

        $lastOrder = MonologueUser::wrap(auth()->user())->lastOrder;

        if (! $lastOrder) {
            return $builder->where('id', false);
        }

        $builder->where('created_at', '<=', $lastOrder->created_at);
    }
}
