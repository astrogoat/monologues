<?php

namespace Astrogoat\Monologues\Models;

use Helix\Lego\Models\User;
use Illuminate\Support\Str;
use Helix\Lego\Models\Model;
use Astrogoat\Monologues\Order;
use Astrogoat\Cashier\Models\Price;
use Astrogoat\Monologues\Enums\Role;
use Astrogoat\Cashier\Models\BillableUser;
use Astrogoat\Monologues\Scopes\AccessScope;
use Helix\Lego\Permissions\Role as StrataRole;

class MonologueUser extends Model
{
    protected $table = 'users';

    public User $user;

    public function getForeignKey(): string
    {
        return 'user_id';
    }

    public static function wrap(User $user)
    {
        $model = new static();

        $model->user = User::find($user->id);

        return $model;
    }

    public function setUser()
    {
        $this->user = User::find($this->id);
    }

    public function orders()
    {
        return $this->user->hasMany(Order::class);
    }

    public function lastOrder()
    {
        return $this->user->hasOne(Order::class)->latestOfMany();
    }

    public function hasDatabaseAccess(): bool
    {
        if ($this->user->hasAnyRole([StrataRole::ADMIN->value, Role::PROMOTIONAL->value])) {
            return true;
        }

        if (BillableUser::fromUser($this->user)->subscribed()) {
            return true;
        }

        foreach ($this->orders()->completed()->get() as $completedOrder) {
            foreach ($completedOrder->price_ids as $priceId) {
                if (in_array($priceId, config('monologues.lifetime_access_price_ids', []))) {
                    return true;
                }
            }
        }

        return false;
    }

    public function monologues()
    {
        return Monologue::query()->withoutGlobalScope(AccessScope::class)
            ->where('created_at', '>', $this->lastOrder->created_at);
    }

    public function newMonologueCount()
    {
        $this->setUser();

        return Monologue::withoutGlobalScope(AccessScope::class)->where('created_at', '>', $this->lastOrder->created_at)->count();
    }

    public static function icon(): string
    {
        return '';
    }
}
