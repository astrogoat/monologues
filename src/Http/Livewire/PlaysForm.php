<?php

namespace Astrogoat\Monologues\Http\Livewire;

use Astrogoat\Monologues\Models\Play;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Rules\SlugRule;

class PlaysForm extends Form
{
    public function mount($play = null)
    {
        $this->setModel($play);
    }

    public function rules(): array
    {
        return [
            'model.title' => 'required',
            'model.slug' => [new SlugRule($this->model)],
            'model.playwright' => 'nullable|string',
            'model.published_year' => 'nullable|numeric',
            'model.type' => 'required',
            'model.where_to_find' => 'nullable|string',
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
