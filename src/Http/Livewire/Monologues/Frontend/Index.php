<?php

namespace Astrogoat\Monologues\Http\Livewire\Monologues\Frontend;

use Astrogoat\Monologues\Enums\CharacterSex;
use Astrogoat\Monologues\Models\Monologue;
use Helix\Lego\Http\Livewire\Models\Index as BaseIndex;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Index extends BaseIndex
{
    public array $casts = [
        'sex' => 'array',
        'age' => 'array',
        'identity' => 'array',
    ];

    public array $sortableColumns = [
        'character' => 'Character',
        'sex' => 'Sex',
        'age' => 'Age',
        'identity' => 'Identity',
    ];

    protected Collection $monologues;

    public function boot(): void
    {
        $this->monologues = Monologue::all();
    }

    public function model(): string
    {
        return Monologue::class;
    }

    public function columns(): array
    {
        return [
            'play_id' => 'Play',
            'playwright' => 'Playwright',
            'character' => 'Character',
            'sex' => 'Sex',
            'age' => 'Age',
            'identity' => 'Identity',
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

    public function scopePlaywright(Builder $query, $value)
    {
        return $query->whereHas('play', function (Builder $builder) use ($value) {
            $builder->where('playwright', 'like', "{$value}%");
        });
    }

    public function sexFilterOptions(): array
    {
        return collect(CharacterSex::cases())
            ->mapWithKeys(fn (CharacterSex $sex) => [$sex->value => $sex->value])
            ->toArray();
    }

    public function ageFilterOptions(): array
    {
        return $this->monologues->pluck('age')
            ->unique()
            ->filter()
            ->mapWithKeys(fn ($age) => [$age => $age])
            ->toArray();
    }

    public function identityFilterOptions(): array
    {
        return $this->monologues->pluck('identity')
            ->unique()
            ->filter()
            ->mapWithKeys(fn ($identity) => [$identity => $identity])
            ->toArray();
    }

    public function render()
    {
        return view('monologues::models.monologues.frontend.index', [
            'models' => $this->getModels(),
        ])->extends('monologues::layouts.monologues')->section('content');
    }
}
