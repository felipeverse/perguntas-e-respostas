@extends('layouts.app')

@section('content')
    <div class="leaderboard m-3">
        <h1>
          <svg class="ico-cup">
            <use xlink:href="#cup"></use>
          </svg>
          Classificação Final
        </h1>
        <ol>
            @foreach ($grupos as $grupo)
                <li>
                    <mark>{{ $grupo->nome }}</mark>
                    <small>{{ $grupo->pontuacao_total }}</small>
                </li>
            @endforeach
        </ol>
    </div>

    {{-- Confetti effect --}}
    <script src="https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.9.3/tsparticles.confetti.bundle.min.js"></script>
    <script>
        const duration = 15 * 1000,
        animationEnd = Date.now() + duration,
        defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

        function randomInRange(min, max) {
        return Math.random() * (max - min) + min;
        }

        const interval = setInterval(function() {
        const timeLeft = animationEnd - Date.now();

        if (timeLeft <= 0) {
            return clearInterval(interval);
        }

        const particleCount = 50 * (timeLeft / duration);

        // since particles fall down, start a bit higher than random
        confetti(
            Object.assign({}, defaults, {
            particleCount,
            origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
            })
        );
        confetti(
            Object.assign({}, defaults, {
            particleCount,
            origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
            })
        );
        }, 250);
    </script>
@endsection
