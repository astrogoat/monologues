<?php

namespace Astrogoat\Monologues\Http\Livewire\Monologues;

use Livewire\Component;
use Astrogoat\Monologues\Models\Monologue;

class Show extends Component
{
    public Monologue $monologue;
    private array $cache = [];

    protected function getPrevious(): ?int
    {
        if (! isset($this->cache['previous'])) {
            $this->cache['previous'] = Monologue::where('id', '<', $this->monologue->id)->max('id');
        }

        return $this->cache['previous'];
    }

    protected function getNext(): ?int
    {
        if (! isset($this->cache['next'])) {
            $this->cache['next'] = Monologue::where('id', '>', $this->monologue->id)->min('id');
        }

        return $this->cache['next'];
    }

    public function hasPrevious(): bool
    {
        return ! ! $this->getPrevious();
    }

    public function hasNext(): bool
    {
        return ! ! $this->getNext();
    }

    public function previous()
    {
        $previous = $this->getPrevious();

        if (! $previous) {
            return;
        }

        return $this->redirect(route('monologue-database.monologues.show', $previous));
    }

    public function next()
    {
        $next = $this->getNext();

        if (! $next) {
            return;
        }

        return $this->redirect(route('monologue-database.monologues.show', $next));
    }

    public function render()
    {
        return view('monologues::models.monologues.show')
            ->extends('monologues::layouts.monologues');
    }
}
