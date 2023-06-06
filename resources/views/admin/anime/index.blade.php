@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h1>Listado de animes</h1>
                    <a href="{{ route('admin.anime.create') }}" class="btn btn-primary">Crear anime</a>
                </div>
                <table class="table table-responsive color-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($animes as $anime)
                            <tr>
                                <td>{{ $anime->id }}</td>
                                <td>{{ $anime->title }}</td>
                                <td>{{ $anime->description }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{route('episodes.index', $anime->id)}}">Ver Episodios</a>

                                    <a href="{{ route('admin.anime.edit', ['id' => $anime->id]) }}" class="btn btn-sm btn-warning">Editar</a>

                                    <form action="{{ route('admin.anime.destroy', $anime->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $anime->id }}">

                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este anime?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection