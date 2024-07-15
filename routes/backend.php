<?php

use Illuminate\Support\Facades\Route;
use Astrogoat\Monologues\Http\Livewire\Monologues\Backend\Form as MonologuesForm;
use Astrogoat\Monologues\Http\Livewire\Plays\Backend\Form as PlaysForm;
use Astrogoat\Monologues\Http\Livewire\Monologues\Backend\Index as MonologuesIndex;
use Astrogoat\Monologues\Http\Livewire\Plays\Backend\Index as PlaysIndex;

Route::group([
    'as' => 'monologues.',
    'prefix' => 'monologue-database',
    'middleware' => ['enabled:Astrogoat\Monologues\Settings\MonologuesSettings'],
], function () {
    Route::get('monologues', MonologuesIndex::class)->name('index');
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
