@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        @include('layouts.partials.messages')

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                Perguntas
                <a href="{{ route('perguntas.create') }}" class="btn btn-primary">Nova</a>
            </div>
            <div class="card-body">
                @include('layouts.partials.messages')
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped no-top-border">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Enunciado</th>
                                    <th scope="col" class="text-end">nível</th>
                                    <th scope="col" class="text-end">tema</th>
                                    <th scope="col" class="text-end">Tipo</th>
                                    <th scope="col" class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($perguntas as $key => $pergunta)
                                <tr>
                                    <td>{{ $pergunta->id }}</td>
                                    <td>{{ $pergunta->enunciado }}</td>
                                    <td class="text-end">{{ $pergunta->nivel->titulo }}</td>
                                    <td class="text-end">{{ $pergunta->tema->titulo }}</td>
                                    <td class="text-end">{{ $pergunta->tipo }}</td>
                                    <td class="text-end">
                                        <div class="button-container">
                                        <a href="{{ route('perguntas.show', $pergunta->id) }}" class="btn btn-primary text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('perguntas.edit', $pergunta->id) }}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                        <form method="POST" action="{{ route('perguntas.destroy', $pergunta->id) }}" class="form d-inline-block" title="Exluir">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir a pergunta?')" ><i class="bi bi-trash"></i></button>
                                        </form>
                                        </div>
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
