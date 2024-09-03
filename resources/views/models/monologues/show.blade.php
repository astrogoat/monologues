@php use Illuminate\Support\Str; @endphp
<x-fab::layouts.page>
    <x-slot:title>
        <a href="{{ route('monologue-database.plays.show', $monologue->play) }}">
            {{ $monologue->play->title }}
        </a>
    </x-slot:title>
    <x-slot name="description">
        by {{ $monologue->play->playwright }} {{ $monologue->play->published_year ? ' (' . $monologue->play->published_year . ')' : '' }}
        @foreach($monologue->genres as $genre)
            <x-fab::elements.badge>
                {{ $genre->name }}
            </x-fab::elements.badge>
        @endforeach
    </x-slot>
    <x-slot name="actions">
{{--        <x-fab::elements.button class="monologues-mr-4" wire:click="bookmark">--}}
{{--            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="monologues-w-6 monologues-h-6"><path d="M6 7.8c0-1.9.03-2.36.21-2.71 .19-.38.49-.69.87-.88 .35-.19.8-.22 2.7-.22h4.4c1.89 0 2.35.03 2.7.21 .37.19.68.49.87.87 .18.35.21.8.21 2.7v13.2l1.49-.87 -7-4c-.31-.18-.69-.18-1 0l-7 4 1.49.86V7.76Zm-2 0V21c0 .76.82 1.24 1.49.86l7-4h-1l7 4c.66.38 1.49-.11 1.49-.87V7.79c0-2.31-.05-2.85-.44-3.62 -.39-.76-1-1.37-1.75-1.75 -.77-.4-1.32-.44-3.62-.44h-4.4c-2.31 0-2.85.04-3.62.43 -.76.38-1.37.99-1.75 1.74 -.4.76-.44 1.31-.44 3.61Z"/></svg>--}}
{{--        </x-fab::elements.button>--}}

        <x-fab::elements.button-group size="xs">
            <x-fab::elements.button-group.button
                position="left"
                wire:click="previous"
                :disabled="! $this->hasPrevious()"
                class="{{ $this->hasPrevious() ? '' : 'monologues-bg-gray-100 hover:monologues-bg-gray-100'}}"
            >
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="monologues-w-6 monologues-h-6">
                    <path fill-rule="evenodd" d="M15.7 5.29c.39.39.39 1.02 0 1.41l-5.3 5.29 5.29 5.29c.39.39.39 1.02 0 1.41 -.4.39-1.03.39-1.42 0l-6.01-6c-.4-.4-.4-1.03 0-1.42l6-6.01c.39-.4 1.02-.4 1.41 0Z"/>
                </svg>
            </x-fab::elements.button-group.button>
            <x-fab::elements.button-group.button
                position="right"
                wire:click="next"
                :disabled="! $this->hasNext()"
                class="{{ $this->hasNext() ? '' : 'monologues-bg-gray-100 hover:monologues-bg-gray-100'}}"
            >
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="monologues-w-6 monologues-h-6">
                    <path fill-rule="evenodd" d="M8.29 5.29c.39-.4 1.02-.4 1.41 0l5.99 6c.39.39.39 1.02 0 1.41l-6 6c-.4.39-1.03.39-1.42 0 -.4-.4-.4-1.03 0-1.42l5.29-5.3 -5.3-5.3c-.4-.4-.4-1.03 0-1.42Z"/>
                </svg>
            </x-fab::elements.button-group.button>
        </x-fab::elements.button-group>
{{--        <div class="monologues-flex monologues-flex-col">--}}
{{--            <div class="monologues-tracking-wide monologues-uppercase monologues-text-xs monologues-font-medium monologues-text-gray-700 monologues-text-right monologues-mb-1">--}}
{{--                Need help with this monologue?--}}
{{--            </div>--}}
{{--            <x-fab::elements.button primary class="monologues-self-end">Book session with PK</x-fab::elements.button>--}}
{{--        </div>--}}
    </x-slot>
    <div class="monologues-grid monologues-grid-cols-1 sm:monologues-grid-cols-3 monologues-gap-4">
        <div class="monologues-flex monologues-flex-col monologues-col-span-2 monologues-gap-4">
            @if($monologue->description)
                <x-fab::layouts.panel title="Monologue Description" class="monologues-text-gray-700">
                    {!! nl2br($monologue->description) !!}
                </x-fab::layouts.panel>
            @endif

            @if($monologue->play->description)
                <x-fab::layouts.panel title="Play Description" class="monologues-text-gray-700">
                    {!! nl2br($monologue->play->description) !!}
                </x-fab::layouts.panel>
            @endif

            <div class="monologues-col-span-2">
                <x-fab::lists.two-column title="Excerpt">
                    <x-fab::lists.two-column.column title="First Line">
                        <x-slot:description class="monologues-whitespace-normal">
                            <div class="fab-text-gray-700">
                                {!! nl2br($monologue->first_line) !!}
                            </div>
                        </x-slot:description>
                    </x-fab::lists.two-column.column>
                    <x-fab::lists.two-column.column title="Last Line">
                        <x-slot:description class="monologues-whitespace-normal">
                            <div class="fab-text-gray-700">
                                {!! nl2br($monologue->last_line) !!}
                            </div>
                        </x-slot:description>
                    </x-fab::lists.two-column.column>
                </x-fab::lists.two-column>
            </div>

            @hasanyrole(['admin', 'editor', 'manager'])
                <x-fab::layouts.panel title="Full Monologue" class="monologues-text-gray-700">
                    {!! nl2br($monologue->text) !!}
                </x-fab::layouts.panel>
            @endhasanyrole
        </div>

        <div class="monologues-space-y-4">
            <x-fab::lists.two-column title="Character">
                <x-fab::lists.two-column.column title="Name" :description="$monologue->character" />

                <x-fab::lists.two-column.column title="Gender Identity">
                    <x-slot:description>
                        @foreach($monologue->genderIdentities as $genderIdentity)
                            <a href="{{ route('monologue-database.monologues.index', ["filter[gender_identities]={$genderIdentity->name}"]) }}">
                                <x-fab::elements.badge>
                                    {{ $genderIdentity->name }}
                                </x-fab::elements.badge>
                            </a>
                        @endforeach
                    </x-slot:description>
                </x-fab::lists.two-column.column>

                <x-fab::lists.two-column.column title="Identity">
                    <x-slot:description>
                        @foreach($monologue->identities as $identity)
                            <a href="{{ route('monologue-database.monologues.index', ["filter[identities]={$identity->name}"]) }}">
                                <x-fab::elements.badge>
                                    {{ $identity->name }}
                                </x-fab::elements.badge>
                            </a>
                        @endforeach
                    </x-slot:description>
                </x-fab::lists.two-column.column>

                <x-fab::lists.two-column.column title="Age">
                    <x-slot:description>
                        @foreach($monologue->ages as $age)
                            <a href="{{ route('monologue-database.monologues.index', ["filter[ages]={$age->name}"]) }}">
                                <x-fab::elements.badge>
                                    {{ $age->name }}
                                </x-fab::elements.badge>
                            </a>
                        @endforeach
                    </x-slot:description>
                </x-fab::lists.two-column.column>
            </x-fab::lists.two-column>

            @if($monologue->getAttribute('sex') || $monologue->getAttribute('age'))
                <x-fab::lists.two-column title="Play Specified Character Information">
                    @if($monologue->getAttribute('sex'))
                        <x-fab::lists.two-column.column
                            title="Sex"
                            :description="$monologue->sex->fullName()"
                        />
                    @endif

                    @if($monologue->getAttribute('age'))
                        <x-fab::lists.two-column.column
                            title="Age"
                            :description="$monologue->age"
                        />
                    @endif
                </x-fab::lists.two-column>
            @endif

            <x-fab::lists.two-column title="Where to Find the Play">
                @foreach($monologue->play->playSources as $source)
                    <x-fab::lists.two-column.column
                        :url="$source->pivot->url"
                        target="_blank"
                    >
                        <x-slot:title>
                            {{ $source->name }}
                        </x-slot:title>

                        @if($source->pivot->url)
                            <x-slot:secondary>
                                <div class="monologues-justify-end monologues-uppercase monologues-tracking-wide monologues-flex">
                                    <div class="monologues-underline monologues-text-xs">Link</div>
                                </div>
                            </x-slot:secondary>
                            <x-slot:icon>
                                <x-fab::elements.icon :icon="Helix\Fabrick\Icon::EXTERNAL_LINK" class="monologues-w-4" />
                            </x-slot:icon>
                        @endif
                    </x-fab::lists.two-column.column>
                @endforeach
            </x-fab::lists.two-column>

            <x-fab::layouts.panel title="Monologue Length">
                <x-slot:actions>
                    <x-fab::elements.badge :color="$monologue->length()->color()">
                        {{ $monologue->length()->value }}
                    </x-fab::elements.badge>
                </x-slot:actions>
                <div class="overflow-hidden rounded-full bg-gray-200">
                    <div class="h-2 rounded-full bg-indigo-600" style="width: {{ $monologue->length()->progressBarWidth() }}%"></div>
                </div>
                <div class="monologues-text-gray-500 monologues-text-sm monologues-flex monologues-justify-between">
                    <span>{{ $monologue->wordCount }} words</span>
                    <span>{{ $monologue->characterCount }} characters</span>
                </div>
            </x-fab::layouts.panel>
        </div>
    </div>

    <x-monologues::ctas.book-session />
</x-fab::layouts.page>
