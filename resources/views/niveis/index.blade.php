@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        @include('layouts.partials.messages')

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                Niveis
                <a href="{{ route('niveis.create') }}" class="btn btn-primary">Novo</a>
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
                                    <th scope="col" class="text-end">Perguntas</th>
                                    <th scope="col" class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($niveis as $key => $nivel)
                                <tr>
                                    <td>{{ $nivel->id }}</td>
                                    <td>{{ $nivel->titulo }}</td>
                                    <td class="text-end">{{ $nivel->perguntas()->count() }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('niveis.show', $nivel->id) }}" class="btn btn-primary text-white bi bi-eye"></a>
                                        <a href="{{ route('niveis.edit', $nivel->id) }}" class="btn btn-success bi bi-pencil-square"></a>
                                        <form method="POST" action="{{ route('niveis.destroy', $nivel->id) }}" class="form d-inline-block" title="Exluir">
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
