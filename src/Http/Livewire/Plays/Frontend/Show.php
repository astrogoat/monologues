<?php

namespace Astrogoat\Monologues\Http\Livewire\Plays\Frontend;

use Livewire\Component;
use Astrogoat\Monologues\Models\Play;

class Show extends Component
{
    public Play $play;

    public function render()
    {
        return view('monologues::models.plays.frontend.show')
            ->extends('monologues::layouts.monologues');
    }
}
