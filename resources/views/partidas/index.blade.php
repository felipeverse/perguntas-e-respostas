@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        @include('layouts.partials.messages')

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                Partidas
                <a href="{{ route('partidas.create') }}" class="btn btn-primary">Nova</a>
            </div>
            <div class="card-body">
                @include('layouts.partials.messages')
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped no-top-border">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Título</th>
                                    <th scope="col" class="text-end">Status</th>
                                    <th scope="col" class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($partidas as $key => $partida)
                                <tr>
                                    <td>{{ $partida->id }}</td>
                                    <td>{{ $partida->titulo }}</td>
                                    <td class="text-end">{{ $partida->status }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('partidas.play', $partida->id) }}" class="btn btn-primary text-white bi bi-play-fill" title="Jogar partida"></a>
                                        <a href="" class="btn btn-success bi bi-graph-up" title="Visualizar resultados"></a>
                                        <form method="POST" action="" class="form d-inline-block" title="Exluir">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger bi bi-trash" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o nível?')" ></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
