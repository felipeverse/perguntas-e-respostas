@extends('layouts.app')

@section('content')
    @include('layouts.partials.messages')

    <div class="card mt-5">
        <div class="card-header">
            Nova partida
        </div>
        <div class="card-body">
            <div class="row">
                <div class="cool-md-12">
                    <form method="POST" action="{{ route('partidas.store') }}">
                        @include('partidas.form', ['buttonText' => 'Salvar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
