<?php

namespace Astrogoat\Monologues\Http\Controllers;

use Illuminate\Http\Request;
use Astrogoat\Monologues\Models\Play;
use Astrogoat\Monologues\Models\Monologue;

class PlaysController
{
    public function show(Request $request, Play $play)
    {
//        return view('lego::sectionables.show', ['sectionable' => $play]);
    }
}
