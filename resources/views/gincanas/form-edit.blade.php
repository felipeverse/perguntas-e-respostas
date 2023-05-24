@csrf
<div class="mb-3">
    <label for="titulo" class="form-label">Título</label>
    <input
        type="text"
        class="form-control mb-3
        @error('titulo') is-invalid @enderror"
        id="titulo"
        name="titulo"
        value="{{ old('titulo', isset($gincana) ? $gincana->titulo : '') }}" required
    >

    <label for="descricao" class="form-label">Descrição</label>
    <textarea
        type="text"
        class="form-control @error('descricao') is-invalid @enderror mb-2"
        id="descricao"
        name="descricao"
        required
    >{{ old('descricao', isset($gincana) ? $gincana->descricao : '') }}</textarea>

    {{-- Grupos --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Grupos</span>
            <a class="btn bi bi-plus-circle text-primary" href="{{ route('gincanas.grupos.create', $gincana->id) }}"></a>
        </div>
        <div class="ms-2 me-2">
            <table class="table">
                @if ($gincana->grupos->count())
                    <tr>
                        <th scope="col" class="text-start" title="Ordem">Ordem</th>
                        <th scope="col" class="text-start" title="Cor">Cor</th>
                        <th scope="col" class="text-start" title="Nome">Nome</th>
                        <th scope="col" class="text-end" title="Ações">Ações</th>
                    </tr>
                    @foreach ($gincana->grupos as $grupo)
                        <tr>
                            <td class="text-start align-middle">#{{ $grupo->ordem }}</td>
                            <td class="text-start align-middle"><i class="bi bi-circle-fill" style="color: {{ $grupo->cor }}"></i></td>
                            <td class="text-start align-middle">{{ $grupo->nome }}</td>
                            <td class="text-end">
                                <a
                                    class="btn bi bi-x-circle text-danger"
                                    href="{{ route('gincanas.grupos.destroy', $grupo->id) }}"
                                    onclick="return confirm('Tem certeza que deseja excluir o grupo?')"
                                ></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">Não há grupos cadastrados.</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    {{-- Fases --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Fases</span>
            <a class="btn bi bi-plus-circle text-primary" href="{{ route('gincanas.fases.create', $gincana->id) }}"></a>
        </div>
        <div class="ms-2 me-2">
            <table class="table">
                @if ($gincana->fases->count())
                    <tr>
                        <th scope="col" title="Ordem">Ordem</th>
                        <th scope="col" title="Título">Nível</th>
                        <th class="text-end" scope="col" title="Pontuação em erro">PE</th>
                        <th class="text-end" scope="col" title="Pontuação em acerto parcial">PP</th>
                        <th class="text-end" scope="col" title="Pontuação em acerto">PA</th>
                        <th class="text-end" scope="col" title="Quantidade de perguntas por grupo">Qtd P.</th>
                        <th class="text-end" scope="col" title="Selecionar tema manualmente">STM.</th>
                        <th class="text-end" scope="col" title="Ações">Ações</th>
                    </tr>
                    @foreach ($gincana->fases as $fase)
                        <tr>
                            <td class="align-middle" scope="col">#{{ $fase->ordem }}</td>
                            <td class="align-middle" scope="col">{{ $fase->nivel->titulo }}</td>
                            <td class="text-end align-middle" scope="col">{{ $fase->pontuacao_erro }}</td>
                            <td class="text-end align-middle" scope="col">{{ $fase->pontuacao_parcial }}</td>
                            <td class="text-end align-middle" scope="col">{{ $fase->pontuacao_acerto }}</td>
                            <td class="text-end align-middle" scope="col">{{ $fase->perguntas_por_grupo }}</td>
                            <td class="text-end align-middle" scope="col">
                                {{ $fase->selecionar_tema_manualmente ? 'Sim' : 'Não' }}
                            </td>
                            <td class="text-end align-middle" scope="col">
                                <a
                                    class="btn bi bi-x-circle text-danger"
                                    href="{{ route('gincanas.fases.destroy', $fase->id) }}"
                                    onclick="return confirm('Tem certeza que deseja excluir a fase?')"
                                ></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">Não há fases cadastradas.</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
<a href="{{ route('gincanas.index') }}" class="btn btn-secondary">Cancelar</a>
