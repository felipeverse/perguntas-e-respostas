@csrf
<div class="mb-3">
    <label for="titulo" class="form-label">Título</label>
    <input
        type="text"
        class="form-control
        @error('titulo') is-invalid @enderror"
        id="titulo"
        name="titulo"
        value="{{ old('titulo', isset($nivel) ? $nivel->titulo : '') }}" required autofocus
    >
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
<a href="{{ route('niveis.index') }}" class="btn btn-secondary">Cancelar</a>
