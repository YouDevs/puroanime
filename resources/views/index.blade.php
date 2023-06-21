@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center gap-0">
      <hr class="">
      <h2>Animés principales</h2>
      @foreach ($animes as $anime)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
          <div class="card card-anime">
            <a href="{{ route('anime.show', $anime->id) }}">
              <img src="{{ asset('animes/thumbnail_images/' . $anime->thumbnail_image) }}" class="card-img img-fluid" alt="">
            </a>
            <div class="card-body">
              <a href="{{ route('anime.show', $anime->id) }}" class="text-decoration-none color-light">
                <h1>
                  {{$anime->title}}
                  {{-- <a href="{{ route('anime.show', $anime->id) }}" class="btn btn-anime-view">Ver +</a> --}}
                </h1>
                <p>{{$anime->description}}</p>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="row justify content-center">
      <hr class="">
      <h2>Animés con mas relleno :V</h2>
    </div>
</div>
@endsection