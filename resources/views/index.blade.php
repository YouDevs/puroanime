@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @foreach ($animes as $anime)
      <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
        <div class="card card-anime">
          <a href="">
            <img src="{{ $anime->thumbnail_image }}" class="card-img img-fluid" alt="">
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
</div>
@endsection