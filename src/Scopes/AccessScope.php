<?php

namespace Astrogoat\Monologues\Scopes;

use Astrogoat\Monologues\Enums\Role;
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
            // Overflow valve to give promotional users, who haven't placed an order, access to all monologues.
            if (auth()->user()->hasRole(Role::PROMOTIONAL->value)) {
                // Scope all monologues.
                return;
            }

            // Don't scope any monologues.
            $builder->where('id', false);
        } else {
            // Scope any monologues that were created before the user signed up.
            $builder->where('created_at', '<=', $lastOrder->created_at);
        }
    }
}
