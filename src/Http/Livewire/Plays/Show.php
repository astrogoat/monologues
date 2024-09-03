<?php

namespace Astrogoat\Monologues\Http\Livewire\Plays;

use Livewire\Component;
use Astrogoat\Monologues\Models\Play;
use Astrogoat\Monologues\Models\Monologue;

class Show extends Component
{
    public Play $play;

    public function getGenres(): array
    {
        return $this->play->monologues->map(function (Monologue $monologue) {
            return $monologue->genres->pluck('name');
        })->flatten()->unique()->toArray();
    }

    public function render()
    {
        return view('monologues::models.plays.show')
            ->extends('monologues::layouts.monologues');
    }
}
