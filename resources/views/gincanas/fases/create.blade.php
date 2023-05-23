@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        @include('layouts.partials.messages')

        <div class="card">
            <div class="card-header">
                Nova fase
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                            <form method="POST" action="{{ route('gincanas.fases.store', $gincana->id) }}" id="gincanas-fase-create-form">
                            @include('gincanas.fases.form', ['buttonText' => 'Salvar'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
