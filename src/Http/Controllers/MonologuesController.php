<?php

namespace Astrogoat\Monologues\Http\Controllers;

use Astrogoat\Monologues\Models\Monologue;
use Illuminate\Http\Request;

class MonologuesController
{
    public function show(Request $request, Monologue $monologue)
    {
        return view('lego::sectionables.show', ['sectionable' => $monologue]);
    }
}
