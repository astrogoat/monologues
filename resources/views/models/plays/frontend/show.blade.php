<div>
    {{ $play->title }}

    <x-fab::lists.table
        title="Monologues"
    >
        <x-slot name="headers">
            <x-fab::lists.table.header>Character</x-fab::lists.table.header>
            <x-fab::lists.table.header>Excerpt</x-fab::lists.table.header>
            <x-fab::lists.table.header :hidden="true"></x-fab::lists.table.header>
        </x-slot>
        @foreach($play->monologues()->paginate(15) as $monologue)
            <x-fab::lists.table.row :odd="$loop->odd">
                <x-fab::lists.table.column primary>
                    <a href="{{ route('monologue-database.monologues.show', $monologue) }}">{{ $monologue->character }}</a>
                </x-fab::lists.table.column>
                <x-fab::lists.table.column>
                    <a href="{{ route('monologue-database.monologues.show', $monologue) }}">{{ Str::limit($monologue->excerpt, 60) }}</a>
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
</div>
