@extends('layouts.app')

@section('content')
    @foreach ($partida->gincana->grupos as $grupo)
        Pontuação {{ $grupo->nome }}: {{ $grupo->pontuacaoPorPartida($partida); }}
    @endforeach

 {{ dd($partida->jogadas) }}
@endsection
