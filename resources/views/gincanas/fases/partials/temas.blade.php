@foreach ($temas as $tema)
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{ $tema->id }}" name="temas[]" checked>
    <label class="form-check-label" for="tema{{ $tema->id }}">{{ $tema->titulo }}</label>
</div>
@endforeach
