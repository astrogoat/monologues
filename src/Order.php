<?php

namespace Astrogoat\Monologues;

use Helix\Lego\Models\User;
use Illuminate\Support\Collection;
use Astrogoat\Cashier\Models\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Astrogoat\Monologues\Enums\OrderStatus;
use Astrogoat\Monologues\Scopes\CompletedScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([CompletedScope::class])]
class Order extends Model
{
    protected $table = 'monologue_orders';

    protected $guarded = [];

    protected $casts = [
        'price_ids' => 'array',
        'status' => OrderStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function byUser(User $user)
    {
        return Order::whereHas('user', fn ($query) => $query->where('user_id', auth()->user()->id));
    }

    public function scopeCompleted(Builder $query): void
    {
        $query->where('status', OrderStatus::COMPLETED);
    }

    public function scopePending(Builder $query): void
    {
        $query->withoutGlobalScope(CompletedScope::class)->where('status', OrderStatus::PENDING);
    }

    public function prices(): Collection
    {
        return collect($this->price_ids)
            ->map(fn ($priceId) => Price::whereStripeId($priceId)->first());
    }
}
