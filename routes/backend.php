<?php

use Illuminate\Support\Facades\Route;
use Astrogoat\Monologues\Http\Livewire\Monologues\Index;
use Astrogoat\Monologues\Http\Livewire\Plays\Form as PlaysForm;
use Astrogoat\Monologues\Http\Livewire\Plays\Index as PlaysIndex;
use Astrogoat\Monologues\Http\Livewire\Monologues\Form as MonologuesForm;

Route::group([
    'as' => 'monologues.',
    'prefix' => 'monologue-database',
    'middleware' => ['enabled:Astrogoat\Monologues\Settings\MonologuesSettings'],
], function () {
    Route::get('monologues', Index::class)->name('index');
    Route::get('monologue/{monologue}/edit', MonologuesForm::class)->name('edit');
    Route::get('play/{play:slug}/monologue/create', MonologuesForm::class)->name('create');

    Route::group([
        'as' => 'plays.',
        'prefix' => 'plays',
        'middleware' => ['enabled:Astrogoat\Monologues\Settings\MonologuesSettings'],
    ], function () {
        Route::get('/', PlaysIndex::class)->name('index');
        Route::get('create', PlaysForm::class)->name('create');
        Route::get('{play}/edit', PlaysForm::class)->name('edit');
    });
});
