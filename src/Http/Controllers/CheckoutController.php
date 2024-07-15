<?php

namespace Astrogoat\Monologues\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Astrogoat\Monologues\Order;
use Astrogoat\Cashier\Models\Price;
use Astrogoat\Monologues\Enums\Role;
use Astrogoat\Cashier\Models\BillableUser;
use Astrogoat\Monologues\Enums\OrderStatus;
use Astrogoat\Monologues\Scopes\CompletedScope;

class CheckoutController
{
    public function checkout(Request $request, Price $price)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'price_ids' => [$price->stripe_id],
            'status' => OrderStatus::PENDING,
        ]);

        return BillableUser::fromUser($request->user())->checkout($order->price_ids, [
            'success_url' => route('monologues.checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('monologues.landing-page'),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);
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

        auth()->user()->assignRole(Role::CUSTOMER->assign());

        return redirect()->route('monologues.app.monologues.index');
    }

    public function cancelled()
    {
        return 'Checkout cancelled';
    }
}
