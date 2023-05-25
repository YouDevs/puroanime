@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{$anime->title}}: Lista de episodios</h1>
        <a href="{{route('episodes.create', $anime->id)}}" class="btn btn-primary mb-3">Crear nuevo episodio</a>

        <table class="table table-responsive color-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Número de episodio</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($episodes as $episode)
                    <tr>
                        <th scope="row">{{$episode->id}}</th>
                        <td>{{$episode->title}}</td>
                        <td>{{$episode->episode_number}}</td>
                        <td>{{$episode->type}}</td>
                        <td>
                            <a href="{{route('episodes.edit', [$anime, $episode->id])}}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{route('episodes.destroy', [$anime->id, $episode->id])}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este episodio?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
