@extends('layouts.app');

@section('content')
    <div class="containter mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                Gincanas
                <a href="{{ route('gincanas.create') }}" class="btn btn-primary">Nova</a>
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
                                    <th scope="col" class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gincanas as $key => $gincana)
                                <tr>
                                    <td>{{ $gincana->id }}</td>
                                    <td>{{ $gincana->titulo }}</td>
                                    <td class="text-end">
                                        <a href="" class="btn btn-info bi bi-play text-light"></a>
                                        <a href="" class="btn btn-primary text-white bi bi-eye"></a>
                                        <a href="{{ route('gincanas.edit', $gincana->id) }}" class="btn btn-success bi bi-pencil-square" title="Editar"></a>
                                        <form method="POST" action="{{ route('gincanas.destroy', $gincana->id) }}" class="form d-inline-block" title="Exluir">
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
