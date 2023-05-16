@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="card">
	  <div class="card-header">
	    Pergunta detalhes
	  </div>
	  <div class="card-body">
	    <p>
		    <strong>Id:</strong> {{ $pergunta->id }}
	    </p>
		    <p><strong>Pergunta:</strong></p>
            <p class="card-text">{{ $pergunta->enunciado }}</p>
        <p>
            <strong>Respostas:</strong>
            @foreach ($pergunta->respostas as $resposta)
            <div class="card {{ $resposta->correta ? 'text-white bg-success' : 'text-dark bg-light' }} mb-3">
                <div class="card-body">
                  <p class="card-text">{{ $resposta->texto }}</p>
                </div>
                </div>
            @endforeach
        </p>
        <a href="{{ route('perguntas.index') }}" class="float-right btn btn-dark">Voltar</a>
	  </div>
	</div>
</div>

@endsection
