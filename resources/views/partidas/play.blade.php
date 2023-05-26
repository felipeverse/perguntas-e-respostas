@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @include('layouts.partials.messages')

        <form method="POST" action="{{ route('partidas.store-response', $partida->id) }}">
            @csrf
            <input type="hidden" name="fase-id" value="{{ $fase->id }}">
            <input type="hidden" name="grupo-id" value="{{ $grupo->id }}">
            <input type="hidden" name="pergunta-ordem" value="{{ $perguntaOrdem }}">
            <input type="hidden" name="pergunta-id" value="{{ $pergunta->id }}">

            <div class="card mb-2">
                <div class="card-header">
                    <i class="bi bi-circle-fill me-2" style="color: {{ $grupo->cor }}"></i>
                    {{ $grupo->nome }}
                </div>
                <div class="card-body">
                    </p>
                        <strong><p class="card-text">{{ $pergunta->enunciado }}</p></strong>
                    <p>
                    <div class="respostas" id="respostas">
                        @if ($pergunta->tipo == 'OBJETIVA')
                            @foreach ($pergunta->respostas as $resposta)
                                <div class="d-grid gap-2 mb-2" style="line-height: 1;">
                                    <input
                                        type="radio"
                                        class="btn-check"
                                        name="resposta-id"
                                        id="{{ $resposta->id }}"
                                        value="{{ $resposta->id }}"
                                        autocomplete="off"
                                    >
                                    <label class="btn btn-outline-primary" for="{{ $resposta->id }}">{{ $resposta->texto }}</label>
                                </div>
                            @endforeach
                        @elseif($pergunta->tipo == 'DISCURSIVA')
                            <div class="d-grid gap-2 mb-2" style="line-height: 1;">
                                <input type="radio" class="btn-check" name="resultado" id="errado" value="errado" autocomplete="off">
                                <label class="btn btn-outline-danger" for="errado">Resposta errada</label>
                            </div>
                            @if($fase->pontuacao_parcial)
                                <div class="d-grid gap-2 mb-2" style="line-height: 1;">
                                    <input type="radio" class="btn-check" name="resultado" id="acerto-parcial" value="acerto-parcial" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="acerto-parcial">Acerto parcial</label>
                                </div>
                            @endif
                            <div class="d-grid gap-2 mb-2" style="line-height: 1;">
                                <input type="radio" class="btn-check" name="resultado" id="correta" value="correta" autocomplete="off">
                                <label class="btn btn-outline-success" for="correta">Resposta correta</label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary disabled" id="btn-confirmar">Confirmar</button>
            </div>
        </form>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/partidaPlayScripts.js') }}"></script>
@endsection
