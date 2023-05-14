@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="card">
	  <div class="card-header">
	    Nível detalhes
	  </div>
	  <div class="card-body">
	    <p>
		    <strong>Id:</strong> {{ $nivel->id }}
	    </p>
        <p>
		    <strong>Título:</strong> {{ $nivel->titulo }}
	    </p>
        <a href="{{ route('niveis.index') }}" class="float-right btn btn-dark">Voltar</a>
	  </div>
	</div>
</div>

@endsection
