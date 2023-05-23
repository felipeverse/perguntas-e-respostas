@csrf
<div class="mb-3">
    {{-- Enunciado --}}
    <label for="enunciado" class="form-label">Enunciado</label>
    <textarea
        type="text"
        class="form-control @error('enunciado') is-invalid @enderror mb-3"
        id="enunciado"
        name="enunciado"
        required autofocus
    >{{ old('enunciado', isset($pergunta) ? $pergunta->enunciado : '') }}</textarea>

    {{-- Nível --}}
    <label for="nivel" class="form-label">Nível</label>
    <select class="form-select mb-3" id="nivel" name="nivel" required>
        <option value="" selected>Selecione um nível</option>
        @foreach ($niveis as $nivel)
            <option value="{{ $nivel->id }}" {{ isset($pergunta) && $pergunta->nivel->id == $nivel->id ? 'selected' : '' }}>
                {{ $nivel->titulo }}
            </option>
        @endforeach
    </select>

    {{-- Tema --}}
    <label for="tema" class="form-label">Tema</label>
    <select class="form-select mb-3" class="form-select mb-3" id="tema" name="tema" required>
    <option value="" selected>Selecione um tema</option>
    @foreach ($temas as $tema)
        <option value="{{ $tema->id }}" {{ isset($pergunta) && $pergunta->tema->id == $tema->id ? 'selected' : '' }}>
            {{ $tema->titulo }}
        </option>
    @endforeach
    </select>

    {{-- Tipo --}}
    <label for="tipo" class="form-label">Tipo</label>
    <select class="form-select mb-3" class="form-select mb-3" id="tipo" name="tipo" required>
    <option value="" selected>Selecione uma opção</option>
    @foreach ($tipos as $tipo)
        <option value="{{ $tipo }}" {{ isset($pergunta) && $pergunta->tipo == $tipo ? 'selected' : ''}}>
            {{ $tipo }}
        </option>
    @endforeach
    </select>

    {{-- OPÇÕES AO EDITAR UMA PERGUNTA --}}
    @if (isset($pergunta))
        @if($pergunta->tipo == 'OBJETIVA')
            {{-- Opções de respostas para perguntas objetivas --}}
            <div id="opcoes-perguntas-objetivas" style="display: block;">
                <label for="respostas" class="form-label">Respostas</label>
                {{ $i = 0 }}
                @foreach ($pergunta->respostas as $resposta)
                    <div class="input-group mb-3 objetive-options">
                        <div class="input-group-text">
                            <input
                                class="form-check-input mt-0" type="radio" name="correta" aria-label="Radio button for correct answer"
                                value="{{ $i++ }}"
                                {{ $resposta->correta ? 'checked required' : '' }}
                            >
                        </div>
                        <input
                            type="text" class="form-control objetive-option-text" name="respostas[]" aria-label="Text input with checkbox" required
                            value="{{ $resposta->texto }}"
                        >
                    </div>
                @endforeach
            </div>

            {{-- Opções de respostas para perguntas discursivas --}}
            <div id="opcoes-perguntas-discursivas" style="display: none;">
                <label for="respostas" class="form-label">Resposta</label>
                <textarea
                    type="text"
                    class="form-control discursive-option-text @error('resposta') is-invalid @enderror mb-3"
                    id="resposta"
                    name="resposta"
                    value=""
                ></textarea>
            </div>
        @elseif($pergunta->tipo === 'DISCURSIVA')
            {{-- Opções de respostas para perguntas discursivas --}}
            <div id="opcoes-perguntas-discursivas" style="display: block;">
                <label for="respostas" class="form-label">Resposta</label>
                <textarea
                    type="text"
                    class="form-control discursive-option-text @error('resposta') is-invalid @enderror mb-3"
                    id="resposta"
                    name="resposta"
                    value=""
                    required
                >{{ old('enunciado', isset($pergunta) ? $pergunta->respostas->first()->texto : '') }}</textarea>
            </div>

            {{-- Opções de respostas para perguntas objetivas --}}
            <div id="opcoes-perguntas-objetivas" style="display: none;">
                <label for="respostas" class="form-label">Respostas</label>
                @for ($i = 0; $i < 4; $i++)
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0 objetive-option-ratio" type="radio" value="{{ $i }}" name="correta" aria-label="Radio button for correct answer">
                        </div>
                        <input type="text" class="form-control objetive-option-text" name="respostas[]" aria-label="Text input with checkbox">
                    </div>
                @endfor
            </div>
        @endif
    {{-- OPÇÕES AO CRIAR UMA NOVA PERGUNTA --}}
    @else
        {{-- Opções de respostas para perguntas objetivas --}}
        <div id="opcoes-perguntas-objetivas" style="display: none;">
            <label for="respostas" class="form-label">Respostas</label>
            @for ($i = 0; $i < 4; $i++)
                <div class="input-group mb-3 objetive-options">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0 objetive-option-ratio" type="radio" value="{{ $i }}" name="correta" aria-label="Radio button for correct answer" {{ $i == 0 ? 'required' : ''}}>
                    </div>
                    <input type="text" class="form-control objetive-option-text" name="respostas[]" aria-label="Text input with checkbox">
                </div>
            @endfor
        </div>

        {{-- Opções de respostas para perguntas discursivas --}}
        <div id="opcoes-perguntas-discursivas" style="display: none;">
            <label for="respostas" class="form-label">Resposta</label>
            <textarea
                type="text"
                class="form-control discursive-option-text @error('resposta') is-invalid @enderror mb-3"
                id="resposta"
                name="resposta"
                value=""
            ></textarea>
        </div>
    @endif

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
<a href="{{ route('perguntas.index') }}" class="btn btn-secondary">Cancelar</a>

{{-- Scripts --}}
<script src="{{ asset('js/perguntasFormScripts.js') }}"></script>
