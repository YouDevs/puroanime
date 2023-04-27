@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3">Crear nuevo episodio</h1>
                <form action="{{ route('episodes.store', $anime) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título del episodio</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="episode_number" class="form-label">Número de episodio</label>
                        <input type="number" class="form-control" id="episode_number" name="episode_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="summary" class="form-label">Resumen</label>
                        <textarea class="form-control" id="summary" name="summary" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="air_date" class="form-label">Fecha de emisión</label>
                        <input type="date" class="form-control" id="air_date" name="air_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de episodio</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="canon">Canon</option>
                            <option value="filler">Relleno</option>
                            <option value="mixed">Mixto</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear episodio</button>
                </form>
            </div>
        </div>
    </div>
@endsection
