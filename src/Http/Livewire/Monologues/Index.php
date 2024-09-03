<?php

namespace Astrogoat\Monologues\Http\Livewire\Monologues;

use Helix\Lego\LegoManager;
use Illuminate\Support\Collection;
use Astrogoat\Monologues\Models\Age;
use Illuminate\Database\Eloquent\Builder;
use Astrogoat\Monologues\Models\Identity;
use Astrogoat\Monologues\Models\Monologue;
use Astrogoat\Monologues\Models\GenderIdentity;
use Helix\Lego\Http\Livewire\Models\Index as BaseIndex;

class Index extends BaseIndex
{
    public array $casts = [
        'sex' => 'array',
        'ages' => 'array',
        'gender_identities' => 'array',
        'identities' => 'array',
    ];

    public array $sortableColumns = [
        'character' => 'Character',
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
            'gender_identities' => 'Gender',
            'ages' => 'Age',
            'identities' => 'Identity',
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

    public function genderIdentitiesFilterOptions(): array
    {
        return GenderIdentity::query()->orderBy('name')->pluck('name', 'name')->toArray();
    }

    public function scopeGenderIdentities(Builder $query, $value): Builder
    {
        return $query->whereHas('genderIdentities', function (Builder $builder) use ($value) {
            $builder->whereIn('name', explode(',', $value));
        });
    }

    public function identitiesFilterOptions(): array
    {
        return Identity::query()->orderBy('name')->pluck('name', 'name')->toArray();
    }

    public function scopeIdentities(Builder $query, $value): Builder
    {
        return $query->whereHas('identities', function (Builder $builder) use ($value) {
            $builder->whereIn('name', explode(',', $value));
        });
    }

    public function agesFilterOptions(): array
    {
        return Age::query()->orderBy('name')->pluck('name', 'name')->toArray();
    }

    public function scopeAges(Builder $query, $value): Builder
    {
        return $query->whereHas('ages', function (Builder $builder) use ($value) {
            $builder->whereIn('name', explode(',', $value));
        });
    }

    public function render()
    {
        $layout = app(LegoManager::class)->isBackendRoute()
            ? 'lego::layouts.lego'
            : 'monologues::layouts.monologues';

        return view('monologues::models.monologues.index', [
            'models' => $this->getModels(),
        ])->extends($layout)->section('content');
    }
}
