@csrf
<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input
        type="text"
        class="form-control
        @error('nome') is-invalid @enderror mb-3"
        id="nome"
        name="nome"
        value="{{ old('titulo', isset($grupo) ? $grupo->nome : '') }}" required autofocus
    >

    <label for="cor" class="form-label">Cor</label>
    <input
        type="color"
        class="form-control form-control-color mb-3"
        id="cor"
        name="cor"
        value="#ffffff"
        title="Escolha uma cor para o grupo"
    >
</div>
<button type="submit" class="btn btn-primary">Adicionar</button>
<a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
