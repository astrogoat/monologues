<?php

namespace Astrogoat\Monologues\Http\Livewire\Plays\Frontend;

use Astrogoat\Monologues\Models\Play;
use Livewire\Component;

class Show extends Component
{
    public Play $play;

    public function render()
    {
        return view('monologues::models.plays.frontend.show')
            ->extends('monologues::layouts.monologues');
    }
}
