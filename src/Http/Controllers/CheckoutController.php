<?php

namespace Astrogoat\Monologues\Http\Controllers;

use Astrogoat\Cashier\Models\BillableUser;
use Astrogoat\Cashier\Models\Price;
use Astrogoat\Monologues\Enums\OrderStatus;
use Astrogoat\Monologues\Enums\Role;
use Astrogoat\Monologues\Order;
use Astrogoat\Monologues\Scopes\CompletedScope;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Astrogoat\Monologues\Settings\MonologuesSettings;

class CheckoutController
{
    public function prices()
    {
        return redirect(app(MonologuesSettings::class)->getPricingPageModel()->getShowRoute());
    }

    public function checkout(Request $request, $price)
    {
        $price = Price::where('stripe_id', $price)->firstOrFail();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'price_ids' => [$price->stripe_id],
            'status' => OrderStatus::PENDING,
        ]);

        try {
            return BillableUser::fromUser($request->user())->checkout($order->price_ids, [
                'mode' => $price->isRecurring() ? 'subscription' : 'payment',
                'success_url' => route('monologue-database.checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => resolve(MonologuesSettings::class)->getLandingPageModel()->getShowRoute(),
                'metadata' => [
                    'order_id' => $order->id,
                ],
                'allow_promotion_codes' => true,
                'consent_collection' => [
                    'promotions' => 'auto',
                    'terms_of_service' => 'required',
                ]
            ]);
        } catch (\Exception $e) {
            return redirect(resolve(MonologuesSettings::class)->getPricingPageModel()->getShowRoute());
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if ($sessionId === null) {
            return;
        }

        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            return;
        }

        $orderId = $session['metadata']['order_id'] ?? null;

        $order = Order::withoutGlobalScope(CompletedScope::class)->findOrFail($orderId);

        $order->update(['status' => OrderStatus::COMPLETED]);

        auth()->user()->assignRole(Role::CUSTOMER->value);

        return redirect()->route('monologue-database.monologues.index');
    }

    public function cancelled()
    {
        return 'Checkout cancelled';
    }
}
