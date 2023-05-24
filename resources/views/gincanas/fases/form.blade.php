@csrf
<div class="mb-3">
    {{-- Niveis --}}
    <label for="nivel" class="form-label">Nível das perguntas</label>
    <select class="form-select mb-3" id="nivel" name="nivel" required>
        <option value="" selected>Selecione um nível</option>
        @foreach ($niveis as $nivel)
            <option value="{{ $nivel->id }}">
                {{ $nivel->titulo }}
            </option>
        @endforeach
    </select>

    {{-- Temas --}}
    <label for="tema" class="form-label">Temas</label>
    <div class="form-group mb-4" id="fase-temas">
    </div>

    {{-- Pontuações da fase --}}
    <div class="row mb-3">
        <div class="col">
            <label for="pontuacao_erro" title="Pontuação em caso de erro" class="form-label">Pontuação Erro:</label>
            <input type="number" class="form-control" min="0" max="100" step="1" value="0" name="pontuacao_erro" required>
        </div>
        <div class="col">
            <label for="pontuacao_parcial" title="Pontuação em parcial" class="form-label">Pontuação parcial:</label>
            <input type="number" class="form-control" min="0" max="100" step="1" value="50" name="pontuacao_parcial" required>
        </div>
        <div class="col">
            <label for="pontuacao_acerto" title="Pontuação em caso de acerto" class="form-label">Pontuação acerto:</label>
            <input type="number" class="form-control" min="0" max="100" step="1" value="100" name="pontuacao_acerto" required>
        </div>
    </div>

    {{-- Quantidade de perguntas por grupos --}}
    <div class="mb-3">
        <label for="perguntas_por_grupo" class="form-label">Perguntas por grupo:</label>
        <input
            type="number"
            class="form-control"
            min="0"
            max="10"
            step="1"
            value=""
            name="perguntas_por_grupo" required
            placeholder="Digite a quantidade de perguntas por grupo"
            oninput="validarInput(this)"
        >
    </div>

    {{-- Selecionar tema manualmente antes de cada jogada --}}
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="selecionar_tema_manualmente" value="1" name="selecionar_tema_manualmente">
        <label class="form-check-label" for="selecionar_tema_manualmente">Selecionar tema manualmente</label>
    </div>
</div>
<button type="submit" class="btn btn-primary">Adicionar fase</button>
<a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>

{{-- Scripts --}}
<script src="{{ asset('js/gincanaFasesFormScripts.js') }}"></script>
