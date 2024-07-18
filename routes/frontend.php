<?php

use Illuminate\Support\Facades\Route;
use Astrogoat\Monologues\Settings\MonologuesSettings;
use Astrogoat\Monologues\Http\Controllers\CheckoutController;
use Astrogoat\Monologues\Http\Livewire\Monologues\Frontend\Show as MonologuesShow;
use Astrogoat\Monologues\Http\Livewire\Plays\Frontend\Show as PlaysShow;
use Astrogoat\Monologues\Http\Livewire\Monologues\Frontend\Index as MonologuesIndex;
use Astrogoat\Monologues\Http\Livewire\Plays\Frontend\Index as PlaysIndex;

Route::group([
    'as' => 'monologue-database.',
    'prefix' => 'app',
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


    Route::group([
        'middleware' => [
            'enabled:' . MonologuesSettings::class,
            'monologue-database-auth',
            'has-database-access'
        ],
    ], function () {
        Route::get('/', function () {
            return redirect()->route('monologue-database.monologues.index');
        });

        Route::group([
            'as' => 'monologues.',
            'prefix' => 'monologues',
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
