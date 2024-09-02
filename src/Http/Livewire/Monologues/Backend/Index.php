<?php

namespace Astrogoat\Monologues\Http\Livewire\Monologues\Backend;

use Astrogoat\Monologues\Models\Genre;
use Astrogoat\Monologues\Models\Monologue;
use Helix\Lego\Http\Livewire\Models\Index as BaseIndex;
use Illuminate\Database\Eloquent\Builder;

class Index extends BaseIndex
{
    public array $casts = [
        'genre' => 'array',
    ];

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
            'genre' => 'Genre',
            'published_year' => 'Year',
            'deleted_at' => 'Archived',
        ];
    }

    public function mainSearchColumn(): string|false
    {
        return 'play_id';
    }

    public function genreFilterOptions(): array
    {
        return Genre::all()->pluck('name', 'name')->toArray();
    }

    public function scopePlayId(Builder $query, $value): void
    {
        $query->whereHas('play', function (Builder $builder) use ($value) {
            $builder->where('title', 'like', "{$value}%");
        });
    }

    public function scopeGenre(Builder $query, $values): void
    {
        if (in_array('All', $values)) {
            return;
        }

        $query->whereHas('genres', function (Builder $builder) use ($values) {
            $builder->whereIn('name', $values);
        });
    }

    public function render()
    {
        return view('monologues::models.monologues.backend.index', [
            'models' => $this->getModels(),
        ])->extends('lego::layouts.lego')->section('content');
    }
}
