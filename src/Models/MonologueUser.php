<?php

namespace Astrogoat\Monologues\Models;

use Astrogoat\Monologues\Order;
use Astrogoat\Monologues\Enums\Role;
use Astrogoat\Monologues\Scopes\AccessScope;
use Helix\Lego\Models\Model;
use Helix\Lego\Models\User;
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
        if ($this->user->hasAnyRole([StrataRole::ADMIN->value, Role::CUSTOMER->value])) {
            return true;
        }

        return $this->orders()->completed()->count() >= 1;
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
