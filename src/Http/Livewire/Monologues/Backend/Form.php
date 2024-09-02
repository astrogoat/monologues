<?php

namespace Astrogoat\Monologues\Http\Livewire\Monologues\Backend;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Astrogoat\Monologues\Models\Play;
use Astrogoat\Monologues\Models\Genre;
use Astrogoat\Monologues\Models\Monologue;
use Astrogoat\Monologues\Enums\CharacterSex;
use Helix\Lego\Services\SyncableRelationship;
use Astrogoat\Monologues\Models\Age;
use Astrogoat\Monologues\Models\Identity;
use Helix\Lego\Http\Livewire\Models\Form as BaseForm;
use Helix\Lego\Http\Livewire\Traits\SyncsRelationships;
use Astrogoat\Monologues\Models\GenderIdentity;

class Form extends BaseForm
{
    use SyncsRelationships;

    public Play $play;

    protected bool $canBeDeleted = true;

    public function mount($monologue = null)
    {
        $this->setModel($monologue);

        if (! $this->model->exists) {
            $playArgument = func_get_arg(1);
            $play = $playArgument instanceof Play ? $playArgument : Play::query()->where('slug', func_get_arg(1))->first();

            $this->model->play()->associate($this->play);
            $this->model->setRelation('play', $play);

            $this->play = $play;
        } else {
            $this->play = $this->model->play;
        }
    }

    public function booted()
    {
        if (! $this->model->play) {
            $this->model->play()->associate($this->play);
            $this->model->setRelation('play', $this->play);
        }
    }

    public function rules(): array
    {
        return [
            'model.character' => 'required|string',
            'model.sex' => [Rule::enum(CharacterSex::class)],
            'model.identity' => 'nullable|string',
            'model.age' => 'nullable|string',
            'model.description' => 'nullable|string',
            'model.excerpt' => 'nullable|string',
            'model.text' => 'nullable|string',
        ];
    }

    public function model(): string
    {
        return Monologue::class;
    }

    public function displayTitle(int $limit = 50): string
    {
        $title = match (true) {
            filled($this->model->excerpt) => Str::of($this->model->excerpt)->remove('[First line]')->prepend($this->model->character . ': '),
            filled($this->model->description) => $this->model->description,
            filled($this->model->text) => $this->model->text,
            default => '[Untitled]',
        };

        return Str::limit($title, $limit);
    }

    public function redirectAfterDeletionRoute(): string
    {
        return route('lego.monologues.plays.edit', $this->play);
    }

    public function syncableRelationships(): array
    {
        return [
            SyncableRelationship::relationship(Genre::class)
                ->name('genres')
                ->inverseRelationshipName('monologues')
                ->labelProperty('name'),
            SyncableRelationship::relationship(GenderIdentity::class)
                ->name('genderIdentities')
                ->labelProperty('name')
                ->inverseRelationshipName('monologues'),
            SyncableRelationship::relationship(Age::class)
                ->name('ages')
                ->labelProperty('name')
                ->inverseRelationshipName('monologues'),
            SyncableRelationship::relationship(Identity::class)
                ->name('identities')
                ->labelProperty('name')
                ->inverseRelationshipName('monologues'),
        ];
    }

    public function view(): string
    {
        return 'monologues::models.monologues.backend.form';
    }
}
