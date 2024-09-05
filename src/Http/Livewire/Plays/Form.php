<?php

namespace Astrogoat\Monologues\Http\Livewire\Plays;

use Helix\Lego\Rules\SlugRule;
use Astrogoat\Monologues\Models\Play;
use Astrogoat\Monologues\Models\PlaySource;
use Helix\Lego\Services\SyncableRelationship;
use Helix\Lego\Http\Livewire\Models\Form as BaseForm;
use Helix\Lego\Http\Livewire\Traits\SyncsRelationships;
use Helix\Lego\Http\Livewire\Traits\RequireConfirmation;

class Form extends BaseForm
{
    use RequireConfirmation;
    use SyncsRelationships;

    public array $playSources = [];

    public function mount($play = null)
    {
        $this->setModel($play);

        foreach ($this->model->playSources as $playSource) {
            $this->playSources[$playSource->id] = $playSource->pivot->url;
        }
    }

    public function saved()
    {
        $data = collect($this->playSources)->mapWithKeys(function ($url, $sourceId) {
            return [$sourceId => ['url' => $url]];
        })->toArray();

        $this->model->playSources()->sync($data);
    }

    public function syncableRelationships(): array
    {
        return [
            SyncableRelationship::relationship(PlaySource::class)
                ->name('playSources')
                ->inverseRelationshipName('plays')
                ->labelProperty('name'),
        ];
    }

    public function rules(): array
    {
        return [
            'model.title' => 'required',
            'model.slug' => [new SlugRule($this->model)],
            'model.playwright' => 'required|string',
            'model.published_year' => 'required|numeric',
            'model.description' => 'required|string',
        ];
    }

    public function model(): string
    {
        return Play::class;
    }

    public function view(): string
    {
        return 'monologues::models.plays.form';
    }
}
