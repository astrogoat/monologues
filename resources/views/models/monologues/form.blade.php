@php
    use Helix\Fabrick\Icon;
    use Illuminate\Support\Str;
    use Astrogoat\Monologues\Enums\CharacterSex;
    use Helix\Lego\Enums\AppAsset;
@endphp

<x-lego::app-asset asset="css/monologues-backend.css" vendor="monologues" :type="AppAsset::STYLESHEET" />

<x-fab::layouts.page
    :breadcrumbs="[
        ['title' => 'Monologues', 'url' => route('lego.monologues.index')],
        ['title' => $model->play->title, 'url' => route('lego.monologues.plays.edit', $this->model->play)],
        ['title' => $this->displayTitle(30)],
    ]"
    description="{{ $model->play->title }} by {{ $model->play->playwright }} ({{ $model->play->published_year ?: '?' }})"
    x-data=""
    x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
    x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
>
    <x-slot name="actions">
        @include('lego::models._includes.forms.page-actions')
    </x-slot>

    <x-slot name="title">
        <div class="flex items-center">
            @if($this->modelSupportsSoftDeletes() && $model->trashed())
                <x-fab::elements.icon :icon="Icon::ARCHIVE" class="monologues-w-8 monologues-h-8 monologues-mr-2" type="solid"/>
            @endif
            <span class="{{ $this->modelSupportsSoftDeletes() && $model->trashed() ? 'monologues-line-through' : '' }}">
                {{ $this->displayTitle() }}
            </span>
        </div>
    </x-slot>

    @if($this->modelSupportsSoftDeletes() && $model->trashed())
        <x-slot name="description">
            This monologue has be archived.
        </x-slot>
    @endif

    <x-fab::layouts.main-with-aside>
        <x-fab::layouts.panel title="Play Specified Character Details">
            <div class="monologues-grid monologues-grid-cols-3 monologues-gap-3">
                <x-fab::forms.input
                    name="model.character"
                    label="Name"
                    wire:model="model.character"
                />

                <x-fab::forms.input
                    name="model.age"
                    label="Age"
                    wire:model="model.age"
                />

                <x-fab::forms.select
                    name="model.sex"
                    label="Sex"
                    wire:model="model.sex"
                >
                    <option>-- Select sex --</option>
                    @foreach(CharacterSex::cases() as $sex)
                        <option value="{{ $sex->value }}">{{ $sex->value }}</option>
                    @endforeach
                </x-fab::forms.select>
            </div>
        </x-fab::layouts.panel>

        <x-fab::layouts.panel title="Monologue Details">
            <x-fab::forms.textarea
                name="model.description"
                label="Description"
                wire:model="model.description"
            />

            <x-fab::forms.textarea
                name="model.first_line"
                label="First lines of monologue"
                wire:model="model.first_line"
            />

            <x-fab::forms.textarea
                name="model.last_line"
                label="Last lines of monologue"
                wire:model="model.last_line"
            />

            <x-fab::forms.textarea
                name="model.text"
                label="Full monologue"
                wire:model="model.text"
                rows="10"
            />
        </x-fab::layouts.panel>

        <x-slot name="aside">
            @foreach($this->syncableRelationships() as $relationship)
                <x-lego::syncable-relationship
                    :relationship="$relationship"
                />
            @endforeach
        </x-slot>
    </x-fab::layouts.main-with-aside>
</x-fab::layouts.page>
