<?php

use Illuminate\Support\Facades\Route;
use Astrogoat\Monologues\Settings\MonologuesSettings;
use Astrogoat\Monologues\Http\Controllers\CheckoutController;
use Astrogoat\Monologues\Http\Controllers\LandingPageController;
use Astrogoat\Monologues\Http\Livewire\Monologues\Frontend\Show as MonologuesShow;
use Astrogoat\Monologues\Http\Livewire\Plays\Frontend\Show as PlaysShow;
use Astrogoat\Monologues\Http\Livewire\Monologues\Frontend\Index as MonologuesIndex;
use Astrogoat\Monologues\Http\Livewire\Plays\Frontend\Index as PlaysIndex;

//Route::get('/subscribe/{price}', function (Request $request, string $price) {
//    return BillableUser::fromUser($request->user())
//        ->newSubscription('default', $price)
//        ->checkout([
//            'success_url' => route('monologues.app.monologues.index'),
//            'cancel_url' => route('monologues'),
//        ]);
//})->name('monologues.subscribe');

Route::group([
    'as' => 'monologues.',
    'prefix' => 'monologues',
], function () {
    Route::group([
        'prefix' => 'checkout',
    ], function () {
        Route::get('success', [CheckoutController::class, 'success'])
            ->name('checkout.success');

        Route::get('cancelled', [CheckoutController::class, 'cancelled'])
            ->name('checkout.cancelled');

        Route::get('{price}', [CheckoutController::class, 'checkout'])
            ->middleware(['monologue-database-auth'])
            ->name('checkout');
    });

    Route::get('/', LandingPageController::class)->name('landing-page');

    Route::group([
        'as' => 'app.',
        'prefix' => 'app',
    ], function () {
        Route::group([
            'middleware' => [
                'enabled:' . MonologuesSettings::class,
//            'permission:' . Permission::ACCESS_MONOLOGUE_DATABASE->check(),
                'auth',
                'has-database-access'
            ],
        ], function () {
            Route::group([
                'as' => 'monologues.',
            ], function () {
                Route::get('/', MonologuesIndex::class)->name('index');
                Route::get('monologues/{monologue:id}', MonologuesShow::class)->name('show');
            });

            Route::group([
                'as' => 'plays.',
                'prefix' => 'plays',
            ], function () {
                Route::get('/', PlaysIndex::class)->name('index');
                Route::get('{play:slug}', PlaysShow::class)->name('show');
            });
        });
    });
});
