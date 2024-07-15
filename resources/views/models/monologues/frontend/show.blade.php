@php use Illuminate\Support\Str; @endphp
<x-fab::layouts.page
    :title="$monologue->play->title"
    :description="$monologue->play->title . ' by ' . $monologue->play->playwright . ($monologue->play->published_year ? ' (' . $monologue->play->published_year . ')' : '')"
>
    <x-slot name="actions">
{{--        <x-fab::elements.button class="monologues-mr-4" wire:click="bookmark">--}}
{{--            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="monologues-w-6 monologues-h-6"><path d="M6 7.8c0-1.9.03-2.36.21-2.71 .19-.38.49-.69.87-.88 .35-.19.8-.22 2.7-.22h4.4c1.89 0 2.35.03 2.7.21 .37.19.68.49.87.87 .18.35.21.8.21 2.7v13.2l1.49-.87 -7-4c-.31-.18-.69-.18-1 0l-7 4 1.49.86V7.76Zm-2 0V21c0 .76.82 1.24 1.49.86l7-4h-1l7 4c.66.38 1.49-.11 1.49-.87V7.79c0-2.31-.05-2.85-.44-3.62 -.39-.76-1-1.37-1.75-1.75 -.77-.4-1.32-.44-3.62-.44h-4.4c-2.31 0-2.85.04-3.62.43 -.76.38-1.37.99-1.75 1.74 -.4.76-.44 1.31-.44 3.61Z"/></svg>--}}
{{--        </x-fab::elements.button>--}}

        <x-fab::elements.button-group>
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
    <x-fab::layouts.panel>
        <x-fab::data-displays.description-lists.left-aligned
            :title="$monologue->description"
        >
            <x-fab::data-displays.description-lists.left-aligned.row label="Character">
                {{ $monologue->character }}
            </x-fab::data-displays.description-lists.left-aligned.row>

            <x-fab::data-displays.description-lists.left-aligned.row label="Sex">
                {{ $monologue->sex }}
            </x-fab::data-displays.description-lists.left-aligned.row>

            <x-fab::data-displays.description-lists.left-aligned.row label="Identity">
                {{ $monologue->identity }}
            </x-fab::data-displays.description-lists.left-aligned.row>

            <x-fab::data-displays.description-lists.left-aligned.row label="Age">
                {{ $monologue->age }}
            </x-fab::data-displays.description-lists.left-aligned.row>

            <x-fab::data-displays.description-lists.left-aligned.row label="Type">
                {{ $monologue->type }}
            </x-fab::data-displays.description-lists.left-aligned.row>

            <x-fab::data-displays.description-lists.left-aligned.row label="Excerpt">
                "{{ Str::finish($monologue->excerpt, '...') }}"
            </x-fab::data-displays.description-lists.left-aligned.row>

            <x-fab::data-displays.description-lists.left-aligned.row label="Where to find">
                {{ $monologue->play->where_to_find }}
            </x-fab::data-displays.description-lists.left-aligned.row>

            <x-fab::data-displays.description-lists.left-aligned.row label="Added">
                {{ $monologue->created_at->diffForHumans() }} <span class="monologues-text-gray-500 monologues-text-xs">({{ $monologue->created_at->toFormattedDateString() }})</span>
            </x-fab::data-displays.description-lists.left-aligned.row>
        </x-fab::data-displays.description-lists.left-aligned>
    </x-fab::layouts.panel>

    <x-monologues::ctas.book-session />
</x-fab::layouts.page>
