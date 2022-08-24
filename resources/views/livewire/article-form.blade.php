<div>
    <h1>Crear articulo</h1>
    <form wire:submit.prevent="save">
        {{--Aqui usamos la propiedad title, porque la definiamos en la clase. En cambio ahora, definimos el modelo article
            <input
            wire:model="title"
            type="text"
            placeholder="Titulo"> --}}
        <input
            wire:model="article.title"
            type="text"
            placeholder="Titulo">
            @error('article.title')
                <div>{{ $message }}</div>
            @enderror
            <textarea
            wire:model="article.content"
            placeholder="Contenido"></textarea>
            @error('article.content')
                <div>{{ $message }}</div>
            @enderror
        <input type="submit" value="Guardar">
    </form>
</div>
