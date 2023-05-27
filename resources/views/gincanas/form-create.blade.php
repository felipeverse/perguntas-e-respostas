@csrf
<div class="mb-3">
    <label for="titulo" class="form-label">Título</label>
    <input
        type="text"
        class="form-control
        @error('titulo') is-invalid @enderror"
        id="titulo"
        name="titulo"
        value="{{ old('titulo', isset($gincana) ? $gincana->titulo : '') }}" required
    >

    <label for="descricao" class="form-label">Descrição</label>
    <textarea
        type="text"
        class="form-control @error('descricao') is-invalid @enderror mb-3"
        id="descricao"
        name="descricao"
    >{{ old('descricao', isset($gincana) ? $gincana->descricao : '') }}</textarea>

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
<a href="{{ route('gincanas.index') }}" class="btn btn-secondary">Cancelar</a>
