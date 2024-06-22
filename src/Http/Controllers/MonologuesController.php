<?php

namespace Astrogoat\Monologues\Http\Controllers;

use Illuminate\Http\Request;
use Astrogoat\Monologues\Models\Monologue;

class MonologuesController
{
    public function show(Request $request, Monologue $monologue)
    {
        return view('lego::sectionables.show', ['sectionable' => $monologue]);
    }
}
