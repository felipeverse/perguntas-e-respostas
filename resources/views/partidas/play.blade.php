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
                    @if ($pergunta->tipo == 'DISCURSIVA')
                        <div class="alert alert-primary" role="alert">
                           Tema: {{ $pergunta->tema->titulo }}
                        </div>
                    @endif
                    </p>
                        <strong><p class="card-text">{{ $pergunta->enunciado }}</p></strong>
                    <p>
                    <div class="respostas" id="respostas">
                        @if ($pergunta->tipo == 'OBJETIVA')
                            @foreach ($pergunta->respostas as $resposta)
                                <input type="hidden" name="ordem-das-respostas[]" value="{{ $resposta->id }}">
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
                            {{-- Resposta --}}

                            <input type="hidden" name="resposta-id" value="{{ $pergunta->respostaCorreta->id }}">
                            <div class="accordion mb-2" id="accordionResposta">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Resposta
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionResposta">
                                        <div class="accordion-body">
                                            <strong>{{ $pergunta->respostaCorreta->texto  }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Resposta --}}
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
