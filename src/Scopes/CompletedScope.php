<?php

namespace Astrogoat\Monologues\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Astrogoat\Monologues\Enums\OrderStatus;

class CompletedScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('status', OrderStatus::COMPLETED);
    }
}
