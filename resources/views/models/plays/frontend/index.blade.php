@php use Astrogoat\Monologues\Models\Play; @endphp
<x-fab::layouts.page
    title="Plays"
{{--    :breadcrumbs="[--}}
{{--        ['title' => 'Home', 'url' => route('lego.dashboard')],--}}
{{--        ['title' => 'Plays','url' => route('lego.monologues.plays.index')],--}}
{{--    ]"--}}
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

        @foreach($models as $play)
            <x-fab::lists.table.row :odd="$loop->odd">
                @if($this->shouldShowColumn('title'))
                    <x-fab::lists.table.column primary text-wrap>
                        <a href="{{ route('monologues.app.plays.show', $play) }}">{{ $play->title }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('playwright'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.plays.show', $play) }}">{{ $play->playwright }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('published_year'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.plays.show', $play) }}">{{ $play->published_year }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('monologues_count'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.plays.show', $play) }}">{{ $play->monologues()->forUser(auth()->user())->count() }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('type'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route('monologues.app.plays.show', $play) }}">{{ $play->type }}</a>
                    </x-fab::lists.table.column>
                @endif

                <x-fab::lists.table.column align="right" slim>
                    <a href="{{ route('monologues.app.plays.show', $play) }}">View</a>
                </x-fab::lists.table.column>

            </x-fab::lists.table.row>
        @endforeach
    </x-fab::lists.table>

    @include('lego::models._includes.indexes.pagination')
</x-fab::layouts.page>
