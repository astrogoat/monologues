<?php

namespace Astrogoat\Monologues\Scopes;

use Astrogoat\Monologues\Enums\Permission;
use Astrogoat\Monologues\Models\MonologueUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AccessScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (! auth()->check()) {
            // Don't scope any monologues.
            $builder->where('id', false);

            return;
        }

        if (auth()->user()->hasRole('admin')) {
            // Scope all monologues.
            return;
        }

        $lastOrder = MonologueUser::wrap(auth()->user())->lastOrder;

        if (! $lastOrder) {
            // Overflow valve to give users who haven't placed an order access.
            if (auth()->user()->hasPermissionTo(Permission::ACCESS_MONOLOGUE_DATABASE->value)) {
                // Scope all monologues.
                return;
            }

            // Don't scope any monologues.
            $builder->where('id', false);
        } else {
            // Scope any monologues that was created before the user singed up.
            $builder->where('created_at', '<=', $lastOrder->created_at);
        }
    }
}
