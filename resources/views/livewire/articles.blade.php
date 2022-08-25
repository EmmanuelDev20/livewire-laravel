<div>
    <h1>Listado de artículos</h1>
    <a href="{{ route('articles.create') }}">Crear</a>
    {{-- <h2>Categoria: {{ $category }}</h2> --}}
    {{-- <h2>Categoria: @json($category) </h2> --}}
    {{-- <h2>Etiquetas: @json($tags) </h2> --}}

    {{-- <input
        wire:model.debounce.150ms="category"
        type="text"
        placeholder="Categoria..."> --}}
    {{-- <input
        wire:model="category.name"
        type="text"
        placeholder="Categoria..."> --}}
    {{-- wire:model.debounce.150ms por defecto 150 milisegundos --}}
    {{-- wire:model.debounce.1s --}}
    {{-- wire:model.lazy --}}
    {{-- wire:model.defer se espera a que haya otra peticion ajax, para sumarse a la misma --}}
    {{-- <label>
        Tag 1
        <input wire:model="tags" type="checkbox" value="tag1">
    </label>
    <label>
        Tag 2
        <input wire:model="tags" type="checkbox" value="tag2">
    </label> --}}
    {{-- <select wire:model="tags">
        <option value="">Seleccione</option>
        <option value="tag1">Tag 1</option>
        <option value="tag2">Tag 2</option>
    </select> --}}
    <input
        wire:model="search"
        type="search"
        placeholder="Search...">
    <h1>{{ $search }}</h1>
    <ul>
        @foreach ($articles as $article)
            <li>
                <a href="{{ route('articles.show', $article) }}">
                    {{ $article->title }}
                </a>
                <a href="{{ route('articles.edit', $article) }}">
                    Editar
                </a>
            </li>
        @endforeach
    </ul>
</div>
