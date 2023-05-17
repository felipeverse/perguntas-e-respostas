@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                Temas
                <a href="{{ route('temas.create') }}" class="btn btn-primary">Novo</a>
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
                            @foreach($temas as $key => $tema)
                                <tr>
                                    <td>{{ $tema->id }}</td>
                                    <td>{{ $tema->titulo }}</td>
                                    <td class="text-end">{{ $tema->perguntas()->count() }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('temas.show', $tema->id) }}" class="btn btn-primary text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('temas.edit',$tema->id) }}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                        <form method="POST" action="{{ route('temas.destroy', $tema->id) }}" class="form d-inline-block" title="Exluir">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o tema?')" ><i class="bi bi-trash"></i></button>
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
