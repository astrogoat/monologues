@php use Illuminate\Support\Str; @endphp

<x-fab::layouts.page
    title="Monologues"
    x-data="{ showColumnFilters: false }"
>
    @include('lego::models._includes.indexes.filters')

    <x-fab::lists.table>
        <x-slot name="headers">
            @include('lego::models._includes.indexes.headers')
            <x-fab::lists.table.header :hidden="true">View</x-fab::lists.table.header>
        </x-slot>

        @include('lego::models._includes.indexes.header-filters')
        <x-fab::lists.table.header x-show="showColumnFilters" x-cloak class="bg-gray-100" />

        @foreach($models->loadMissing('play') as $monologue)
            <x-fab::lists.table.row :odd="$loop->odd">
                @if($this->shouldShowColumn('play_id'))
                    <x-fab::lists.table.column primary text-wrap>
                        <a href="{{ route('monologues.app.monologues.show', $monologue) }}">{{ $monologue->play->title }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('playwright'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.monologues.show', $monologue) }}">{{ $monologue->play->playwright }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('character'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.monologues.show', $monologue) }}">{{ $monologue->character }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('sex'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.monologues.show', $monologue) }}">{{ $monologue->sex }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('age'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.monologues.show', $monologue) }}">{{ $monologue->age }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('identity'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.monologues.show', $monologue) }}">{{ $monologue->identity }}</a>
                    </x-fab::lists.table.column>
                @endif

                <x-fab::lists.table.column align="right" slim>
                    <a href="{{ route('monologues.app.monologues.show', $monologue) }}">View</a>
                </x-fab::lists.table.column>

            </x-fab::lists.table.row>
        @endforeach
    </x-fab::lists.table>

    @include('lego::models._includes.indexes.pagination')

    <x-monologues::ctas.help-find-a-monologue />
</x-fab::layouts.page>
