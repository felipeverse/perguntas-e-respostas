@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Editar tema
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('temas.update', $tema->id) }}">
                            {{ method_field('PUT') }}
                            @include('temas.form',['buttonText' => 'Salvar'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
