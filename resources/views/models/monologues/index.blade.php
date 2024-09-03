@php
    use Illuminate\Support\Str;
    use Helix\Lego\LegoManager;

    $showRoute = app(LegoManager::class)->isBackendRoute()
        ? 'lego.monologues.edit'
        : 'monologue-database.monologues.show';
@endphp

<x-fab::layouts.page
    title="Monologues"
    x-data="{ showColumnFilters: true }"
>
    @include('lego::models._includes.indexes.filters')

    <x-fab::lists.table>
        <x-slot name="headers">
            @include('lego::models._includes.indexes.headers')
            <x-fab::lists.table.header>View</x-fab::lists.table.header>
        </x-slot>

        @include('lego::models._includes.indexes.header-filters')
        <x-fab::lists.table.header x-show="showColumnFilters" x-cloak class="bg-gray-100" />

        @forelse($models->loadMissing('play') as $monologue)
            <x-fab::lists.table.row :odd="$loop->odd">
                @if($this->shouldShowColumn('play_id'))
                    <x-fab::lists.table.column primary text-wrap>
                        <a href="{{ route($showRoute, $monologue) }}">{{ $monologue->play->title }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('playwright'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route($showRoute, $monologue) }}">{{ $monologue->play->playwright }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('character'))
                    <x-fab::lists.table.column text-wrap>
                        <a href="{{ route($showRoute, $monologue) }}">{{ $monologue->character }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('gender_identities'))
                    <x-fab::lists.table.column text-wrap>
                        @foreach($monologue->genderIdentities as $gender)
                            <x-fab::elements.badge class="mr-1">
                                {{ $gender->name }}
                            </x-fab::elements.badge>
                        @endforeach
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('ages'))
                    <x-fab::lists.table.column text-wrap>
                        @foreach($monologue->ages as $age)
                            <x-fab::elements.badge class="mr-1">
                                {{ $age->name }}
                            </x-fab::elements.badge>
                        @endforeach
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('identities'))
                    <x-fab::lists.table.column text-wrap>
                        @foreach($monologue->identities as $identity)
                            <x-fab::elements.badge class="mr-1">
                                {{ $identity->name }}
                            </x-fab::elements.badge>
                        @endforeach
                    </x-fab::lists.table.column>
                @endif

                <x-fab::lists.table.column align="right" slim>
                    <a href="{{ route($showRoute, $monologue) }}">View</a>
                </x-fab::lists.table.column>

            </x-fab::lists.table.row>
        @empty
            <x-fab::lists.table.row :hover="false">
                <x-fab::lists.table.column text-wrap colspan="9">
                    <div class="monologues-h-96 monologues-text-xl monologues-tracking-wide monologues-font-light monologues-flex monologues-items-center monologues-justify-center">No results found</div>
                </x-fab::lists.table.column>
            </x-fab::lists.table.row>
        @endforelse
    </x-fab::lists.table>

    @include('lego::models._includes.indexes.pagination')

    <x-monologues::ctas.help-find-a-monologue />
</x-fab::layouts.page>
