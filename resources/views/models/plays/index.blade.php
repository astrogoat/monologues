@php
    use Astrogoat\Monologues\Models\Play;
    use Helix\Lego\LegoManager;

    $showRoute = app(LegoManager::class)->isBackendRoute()
        ? 'lego.monologues.plays.edit'
        : 'monologue-database.plays.show';
@endphp

<x-fab::layouts.page
    title="Plays"
    x-data="{ showColumnFilters: true }"
>
    @include('lego::models._includes.indexes.filters')

    @if(app(LegoManager::class)->isBackendRoute())
        <x-slot name="actions">
            <a href="{{ route('lego.monologues.plays.create') }}">
                <x-fab::elements.button>Add new play</x-fab::elements.button>
            </a>
        </x-slot>
    @endif

    <x-fab::lists.table>
        <x-slot name="headers">
            @include('lego::models._includes.indexes.headers')
            <x-fab::lists.table.header :hidden="true">View</x-fab::lists.table.header>
        </x-slot>

        @include('lego::models._includes.indexes.header-filters')
        <x-fab::lists.table.header x-show="showColumnFilters" x-cloak class="bg-gray-100" />

        @foreach($models as $play)
            <x-fab::lists.table.row :odd="$loop->odd">
                @if($this->shouldShowColumn('title'))
                    <x-fab::lists.table.column primary text-wrap>
                        <a href="{{ route($showRoute, $play) }}">{{ $play->title }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('playwright'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route($showRoute, $play) }}">{{ $play->playwright }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('published_year'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route($showRoute, $play) }}">{{ $play->published_year }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('monologues_count'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route($showRoute, $play) }}">{{ $play->monologues()->forUser(auth()->user())->count() }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('genre'))
                    <x-fab::lists.table.column text-wrap>
                        @foreach($this->getGenres($play) as $genre)
                            <x-fab::elements.badge>
                                {{ $genre }}
                            </x-fab::elements.badge>
                        @endforeach
                    </x-fab::lists.table.column>
                @endif

                <x-fab::lists.table.column align="right" slim>
                    <a href="{{ route($showRoute, $play) }}">View</a>
                </x-fab::lists.table.column>

            </x-fab::lists.table.row>
        @endforeach
    </x-fab::lists.table>

    @include('lego::models._includes.indexes.pagination')
</x-fab::layouts.page>
