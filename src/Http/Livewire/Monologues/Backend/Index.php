<?php

namespace Astrogoat\Monologues\Http\Livewire\Monologues\Backend;

use Astrogoat\Monologues\Models\Monologue;
use Helix\Lego\Http\Livewire\Models\Index as BaseIndex;
use Illuminate\Database\Eloquent\Builder;

class Index extends BaseIndex
{
    public function model(): string
    {
        return Monologue::class;
    }

    public function columns(): array
    {
        return [
            'play_id' => 'Play',
            'character' => 'Character',
            'excerpt' => 'Excerpt',
            'playwright' => 'Playwright',
            'published_year' => 'Year',
            'deleted_at' => 'Archived',
        ];
    }

    public function mainSearchColumn(): string|false
    {
        return 'play_id';
    }

    public function scopePlayId(Builder $query, $value)
    {
        return $query->whereHas('play', function (Builder $builder) use ($value) {
            $builder->where('title', 'like', "{$value}%");
        });
    }

    public function render()
    {
        return view('monologues::models.monologues.backend.index', [
            'models' => $this->getModels(),
        ])->extends('lego::layouts.lego')->section('content');
    }
}
