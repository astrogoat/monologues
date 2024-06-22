@php use Illuminate\Support\Str; @endphp
<x-fab::layouts.page
    title="Monologues"
    :breadcrumbs="[
        ['title' => 'Home', 'url' => route('lego.dashboard')],
        ['title' => 'Monologues','url' => route('lego.monologues.index')],
    ]"
    x-data="{ showColumnFilters: false }"
>
    @include('lego::models._includes.indexes.filters')

    <x-fab::lists.table>
        <x-slot name="headers">
            @include('lego::models._includes.indexes.headers')
            <x-fab::lists.table.header :hidden="true">Edit</x-fab::lists.table.header>
        </x-slot>

        @include('lego::models._includes.indexes.header-filters')
        <x-fab::lists.table.header x-show="showColumnFilters" x-cloak class="bg-gray-100" />

        @foreach($models->loadMissing('play') as $monologue)
            <x-fab::lists.table.row :odd="$loop->odd">
                @if($this->shouldShowColumn('play_id'))
                    <x-fab::lists.table.column primary text-wrap>
                        <a href="{{ route('lego.monologues.edit', $monologue) }}">{{ $monologue->play->title }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('character'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('lego.monologues.edit', $monologue) }}">{{ $monologue->character }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('excerpt'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('lego.monologues.edit', $monologue) }}">{{ Str::limit($monologue->excerpt, 60) }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('playwright'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('lego.monologues.edit', $monologue) }}">{{ $monologue->play->playwright }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('published_year'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('lego.monologues.edit', $monologue) }}">{{ $monologue->play->published_year }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('deleted_at'))
                    <x-fab::lists.table.column text-wrap>
                        {{ $monologue->trashed() ? 'Archived' : '' }}
                    </x-fab::lists.table.column>
                @endif

                <x-fab::lists.table.column align="right" slim>
                    <a href="{{ route('lego.monologues.edit', $monologue) }}">Edit</a>
                </x-fab::lists.table.column>

            </x-fab::lists.table.row>
        @endforeach
    </x-fab::lists.table>

    @include('lego::models._includes.indexes.pagination')
</x-fab::layouts.page>
