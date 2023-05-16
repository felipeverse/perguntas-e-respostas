@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Nova pergunta
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('perguntas.store') }}">
                            @include('perguntas.form',['buttonText' => 'Salvar'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
