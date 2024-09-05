@php
    use Helix\Fabrick\Icon;
    use Illuminate\Support\Str;
    use Astrogoat\Monologues\Models\Genre;
    use Astrogoat\Monologues\Models\PlaySource;use Astrogoat\Monologues\Enums\TheatricalType;
    use Helix\Lego\Enums\AppAsset;
@endphp

<x-lego::app-asset
    asset="css/monologues-backend.css"
    vendor="monologues"
    :type="AppAsset::STYLESHEET"
/>

<x-fab::layouts.page
    :breadcrumbs="[
        ['title' => 'Plays', 'url' => route('lego.monologues.plays.index')],
        ['title' => $model->title ?: '[Title]'],
    ]"
    x-data=""
    x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
    x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
>
    <x-slot name="title">
        <div class="flex items-center">
            @if($this->modelSupportsSoftDeletes() && $model->trashed())
                <x-fab::elements.icon :icon="Icon::ARCHIVE" class="sh-w-8 sh-h-8 sh-mr-2" type="solid"/>
            @endif
            <span
                class="{{ $this->modelSupportsSoftDeletes() && $model->trashed() ? 'sh-line-through' : '' }}">{{ $model->title ?: '[Title]' }}</span>
        </div>
    </x-slot>
    @if($this->modelSupportsSoftDeletes() && $model->trashed())
        <x-slot name="description">
            This play has be archived
        </x-slot>
    @endif

    <x-fab::layouts.main-with-aside>
        <x-fab::layouts.panel title="Play Details">
            <div class="monologues-grid monologues-grid-cols-3 monologues-gap-3">
                <x-fab::forms.input
                    name="model.title"
                    label="Title"
                    wire:model="model.title"
                />

                <x-fab::forms.input
                    name="model.playwright"
                    label="Playwright"
                    wire:model="model.playwright"
                />

                <x-fab::forms.select
                    name="model.published_year"
                    label="Published Year"
                    wire:model="model.published_year"
                >
                    <option>-- Select --</option>
                    @foreach(range(date('Y'), 1900, -1) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </x-fab::forms.select>
            </div>
        </x-fab::layouts.panel>

        <x-fab::layouts.panel title="Description">
            <x-fab::forms.textarea
                name="model.description"
                label="Play Description/Synopsis"
                wire:model="model.description"
            />
        </x-fab::layouts.panel>

        <x-fab::layouts.panel
            title="Where to find"
        >
            <div class="monologues-space-y-4">
                @foreach($this->syncableRelationships['playSources'] as $sourceId)
                    @php($source = PlaySource::find($sourceId))
                    <div class="monologues-flex monologues-items-center monologues-w-full monologues-gap-3">
                        <div class="monologues-text-sm monologues-font-semibold">{{ $source->name }}</div>
                        <x-fab::forms.input
                            placeholder="https://"
                            class="monologues-flex-1"
                            size="sm"
                            wire:model="playSources.{{ $source->id }}"
                        />
                    </div>
                @endforeach
            </div>
        </x-fab::layouts.panel>

        <x-fab::lists.table
            title="Monologues"
        >
            @if($model->exists)
                <x-slot name="actions">
                    <x-fab::elements.button size="xs">
                        <a href="{{ route('lego.monologues.index', ['filter[play_id]' => $model->title]) }}">View
                            All</a>
                    </x-fab::elements.button>

                    <x-fab::elements.button size="xs">
                        <a href="{{ route('lego.monologues.create', $model) }}">Add Monologue</a>
                    </x-fab::elements.button>
                </x-slot>
            @endif

            <x-slot name="headers">
                <x-fab::lists.table.header>Character</x-fab::lists.table.header>
                <x-fab::lists.table.header>First line</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true"></x-fab::lists.table.header>
            </x-slot>

            @foreach($this->model->monologues()->paginate(15) as $monologue)
                <x-fab::lists.table.row :odd="$loop->odd">
                    <x-fab::lists.table.column primary>
                        <a href="{{ route('lego.monologues.edit', [$monologue]) }}">{{ $monologue->character }}</a>
                    </x-fab::lists.table.column>

                    <x-fab::lists.table.column>
                        <a href="{{ route('lego.monologues.edit', [$monologue]) }}">{{ Str::limit($monologue->first_line, 60) }}</a>
                    </x-fab::lists.table.column>

                    <x-fab::lists.table.column align="right">
                        <x-fab::elements.button size="xs">
                            <a href="{{ route('lego.monologues.edit', [$monologue]) }}">Edit</a>
                        </x-fab::elements.button>
                    </x-fab::lists.table.column>
                </x-fab::lists.table.row>
            @endforeach
        </x-fab::lists.table>

        {{ $this->model->monologues()->paginate(15)->links() }}

        <x-slot name="aside">
            @foreach($this->syncableRelationships() as $relationship)
                <x-lego::syncable-relationship
                    :relationship="$relationship"
                />
            @endforeach

            <x-fab::layouts.panel title="URL Structure">
                <x-fab::forms.input
                    name="model.slug"
                    wire:model.debounce.500ms="model.slug"
                    label="URL and handle (slug)"
                    :help="url('') . Route::getRoutes()->getByName('monologue-database.plays.show')->getPrefix() . '/' . $model->slug . '<br><br>The URL where this monologue can be viewed. Changing this will break any existing links users may have bookmarked.'"
                    :disabled="! $model->exists"
                />
            </x-fab::layouts.panel>
        </x-slot>
    </x-fab::layouts.main-with-aside>
</x-fab::layouts.page>
