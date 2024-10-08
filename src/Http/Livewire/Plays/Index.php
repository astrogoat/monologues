<?php

namespace Astrogoat\Monologues\Http\Livewire\Plays;

use Helix\Lego\LegoManager;
use Astrogoat\Monologues\Models\Play;
use Astrogoat\Monologues\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
use Astrogoat\Monologues\Models\Monologue;
use Helix\Lego\Http\Livewire\Models\Index as BaseIndex;

class Index extends BaseIndex
{
    public array $casts = [
        'genre' => 'array',
        'monologues_count' => 'int',
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
            'monologues_count' => 'Monologues',
            'genre' => 'Genre',
        ];
    }

    public function mainSearchColumn(): string|false
    {
        return 'title';
    }

    public function genreFilterOptions(): array
    {
        return Genre::query()->orderBy('name')->pluck('name', 'name')->toArray();
    }

    public function scopeGenre(Builder $query, $value)
    {
        return $query->whereHas('monologues.genres', function (Builder $builder) use ($value) {
            $builder->whereIn('name', explode(',', $value));
        });
    }

    public function getGenres(Play $play): array
    {
        return $play->monologues->map(function (Monologue $monologue) {
            return $monologue->genres->pluck('name');
        })->flatten()->unique()->toArray();
    }

    public function render()
    {
        $layout = app(LegoManager::class)->isBackendRoute()
            ? 'lego::layouts.lego'
            : 'monologues::layouts.monologues';

        return view('monologues::models.plays.index', [
            'models' => $this->getModels(),
        ])->extends($layout)->section('content');
    }
}
