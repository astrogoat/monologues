<?php

namespace Astrogoat\Monologues\Http\Controllers;

use Astrogoat\Monologues\Models\Play;
use Illuminate\Http\Request;

class PlaysController
{
    public function show(Request $request, Play $play)
    {
        //        return view('lego::sectionables.show', ['sectionable' => $play]);
    }
}
