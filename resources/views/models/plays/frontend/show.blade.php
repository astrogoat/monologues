<x-fab::layouts.page :title="$play->title">
    <x-slot name="description">
        by {{ $play->playwright }} {{ $play->published_year ? ' (' . $play->published_year . ')' : '' }}
        @foreach($this->getGenres() as $genre)
            <x-fab::elements.badge>
                {{ $genre }}
            </x-fab::elements.badge>
        @endforeach
    </x-slot>

    <x-fab::lists.table
        title="Monologues"
    >
        <x-slot name="headers">
            <x-fab::lists.table.header>Character</x-fab::lists.table.header>
            <x-fab::lists.table.header>First line</x-fab::lists.table.header>
            <x-fab::lists.table.header>Gender</x-fab::lists.table.header>
            <x-fab::lists.table.header>Age</x-fab::lists.table.header>
            <x-fab::lists.table.header>Identity</x-fab::lists.table.header>
        </x-slot>
        @foreach($play->monologues()->paginate(15) as $monologue)
            <x-fab::lists.table.row :odd="$loop->odd">
                <x-fab::lists.table.column primary>
                    <a href="{{ route('monologue-database.monologues.show', $monologue) }}">{{ $monologue->character }}</a>
                </x-fab::lists.table.column>
                <x-fab::lists.table.column>
                    <a href="{{ route('monologue-database.monologues.show', $monologue) }}">{{ Str::limit($monologue->excerptsFirstLine, 40) }}</a>
                </x-fab::lists.table.column>
                <x-fab::lists.table.column text-wrap>
                    @foreach($monologue->genderIdentities as $gender)
                        <x-fab::elements.badge class="mr-1">
                            {{ $gender->name }}
                        </x-fab::elements.badge>
                    @endforeach
                </x-fab::lists.table.column>
                <x-fab::lists.table.column>
                    @foreach($monologue->ages as $age)
                        <x-fab::elements.badge class="mr-1">
                            {{ $age->name }}
                        </x-fab::elements.badge>
                    @endforeach
                </x-fab::lists.table.column>
                <x-fab::lists.table.column text-wrap>
                    @foreach($monologue->identities as $identity)
                        <x-fab::elements.badge class="mr-1">
                            {{ $identity->name }}
                        </x-fab::elements.badge>
                    @endforeach
                </x-fab::lists.table.column>
                <x-fab::lists.table.column align="right">
                    <x-fab::elements.button size="xs">
                        <a href="{{ route('monologue-database.monologues.show', $monologue) }}">View</a>
                    </x-fab::elements.button>
                </x-fab::lists.table.column>
            </x-fab::lists.table.row>
        @endforeach
    </x-fab::lists.table>

    {{ $play->monologues()->paginate(15)->links() }}
</x-fab::layouts.page>
