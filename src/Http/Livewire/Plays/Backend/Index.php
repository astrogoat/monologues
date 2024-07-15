<?php

namespace Astrogoat\Monologues\Http\Livewire\Plays\Backend;

use Astrogoat\Monologues\Enums\TheatricalType;
use Astrogoat\Monologues\Models\Play;
use Helix\Lego\Http\Livewire\Models\Index as BaseIndex;

class Index extends BaseIndex
{
    public array $casts = [
        'type' => 'array',
    ];

    public function model(): string
    {
        return Play::class;
    }

    public function columns(): array
    {
        return [
            'title' => 'Title',
            'playwright' => 'Playwright',
            'published_year' => 'Year',
            'type' => 'Type',
        ];
    }

    public function mainSearchColumn(): string|false
    {
        return 'title';
    }

    public function typeFilterOptions(): array
    {
        return collect(TheatricalType::cases())
            ->mapWithKeys(fn (TheatricalType $case) => [$case->value => $case->value])
            ->toArray();
    }

    public function render()
    {
        return view('monologues::models.plays.backend.index', [
            'models' => $this->getModels(),
        ])->extends('lego::layouts.lego')->section('content');
    }
}
