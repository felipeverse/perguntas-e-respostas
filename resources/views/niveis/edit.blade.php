@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        @include('layouts.partials.messages')

        <div class="card">
            <div class="card-header">
                Editar nível
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('niveis.update', $nivel->id) }}">
                            {{ method_field('PUT') }}
                            @include('niveis.form',['buttonText' => 'Salvar'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
