@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="card">
	  <div class="card-header">
	    Tema detalhes
	  </div>
	  <div class="card-body">
	    <p>
		    <strong>Id:</strong> {{ $tema->id }}
	    </p>
        <p>
		    <strong>Título:</strong> {{ $tema->titulo }}
	    </p>
        <a href="{{ route('temas.index') }}" class="float-right btn btn-dark">Voltar</a>
	  </div>
	</div>
</div>

@endsection
