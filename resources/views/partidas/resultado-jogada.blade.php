@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @include('layouts.partials.messages')

        <div class="card mb-2">
            <div class="card-header">
                <i class="bi bi-circle-fill me-2" style="color: {{ $grupo->cor }}"></i>
                {{ $grupo->nome }}
            </div>
            <div class="card-body">
                </p>
                    <strong><p class="card-text">{{ $pergunta->enunciado }}</p></strong>
                <p>
                <div>

                {{-- Inicia indice das letras na posição 0 --}}
                @php $indice = 0; @endphp

                @foreach ($pergunta->respostas as $resposta)

                    {{-- atribui e incremeta letra da resposta --}}
                    @php $letra = chr(65 + $indice++); @endphp

                    @if ($resposta->correta)
                        <div class="d-grid gap-2 mb-2" style="pointer-events:none;">
                            <label class="btn btn-success no-hover" for="{{ $resposta->id }}">
                                <span class="letra">{{ $letra }}) </span>
                                {{ $resposta->texto }}
                                <i class="bi bi-check-circle float-end"></i>
                            </label>
                        </div>
                    @elseif($resposta->id == $respostaEnviada->id)
                        <div class="d-grid gap-2 mb-2 no-hover" style="pointer-events:none;">
                            <label class="btn btn-outline-danger no-hover" for="{{ $resposta->id }}">
                                <span class="letra">{{ $letra }}) </span>
                                {{ $resposta->texto }}
                                <i class="bi bi-x-circle float-end"></i>
                            </label>
                        </div>
                    @else
                        <div class="d-grid gap-2 mb-2 no-hover" style="pointer-events:none;">
                            <label class="btn btn-outline-secondary no-hover" for="{{ $resposta->id }}">
                                <span class="letra">{{ $letra }}) </span>
                                {{ $resposta->texto }}
                            </label>
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
        <div class="d-grid gap-2">
            <a class="btn btn-primary" href="{{ route('partidas.play', $partida->id) }}">Próxima</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.9.3/tsparticles.confetti.bundle.min.js"></script>
    @if ($jogada->correta == 'C')
        <script>
            const count = 200,
            defaults = {
                origin: { y: 0.7 },
            };

            function fire(particleRatio, opts) {
                confetti(
                    Object.assign({}, defaults, opts, {
                    particleCount: Math.floor(count * particleRatio),
                    })
                );
                }

                fire(0.25, {
                spread: 26,
                startVelocity: 55,
                });

                fire(0.2, {
                spread: 60,
                });

                fire(0.35, {
                spread: 100,
                decay: 0.91,
                scalar: 0.8,
                });

                fire(0.1, {
                spread: 120,
                startVelocity: 25,
                decay: 0.92,
                scalar: 1.2,
                });

                fire(0.1, {
                spread: 120,
                startVelocity: 45,
            });
        </script>
    @endif
@endsection
