@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        @include('layouts.partials.messages')

        <div class="card">
            <div class="card-header">
                Novo grupo
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('gincanas.grupos.store', $gincana->id) }}">
                            @include('gincanas.grupos.form', ['buttonText' => 'Salvar'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
