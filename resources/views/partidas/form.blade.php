@csrf
<div class="mb-3">
    <label for="titulo" class="form-label">Título</label>
    <input
        type="text"
        class="form-control
        @error('titulo') is-invalid @enderror mb-3"
        id="titulo"
        name="titulo"
        value="{{ old('titulo', isset($partida) ? $partida->titulo : '') }}" required autofocus
    >

    <label for="gincana-modelo" class="form-label">Gincana modelo</label>
    <select class="form-select mb-3" class="form-select mb-3" id="gincana" name="gincana" required>
        <option value="" selected>Selecione uma opção</option>
        @foreach ($gincanas as $gincana)
            <option value="{{ $gincana->id }}" {{ isset($partida) && $partida->gincana == $gincana ? 'selected' : ''}}>
                {{ $gincana->titulo }}
            </option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
<a href="{{ route('partidas.index') }}" class="btn btn-secondary">Cancelar</a>
