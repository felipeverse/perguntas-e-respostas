@extends('layouts.app')

@section('content')
    @foreach ($grupos as $grupo)
        <div>
            {{ $grupo->nome }} : {{ $grupo->pontuacao_total }}
        </div>
    @endforeach
@endsection
