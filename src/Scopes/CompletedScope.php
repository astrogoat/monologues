<?php

namespace Astrogoat\Monologues\Scopes;

use Astrogoat\Monologues\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CompletedScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('status', OrderStatus::COMPLETED);
    }
}
