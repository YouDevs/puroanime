@extends('layouts.app')

@section('styles')
<style>
.btn-anime-view {
    background-color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
    color: #ffffff !important;
    border-radius: 20px;
    padding: 5px 15px;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.btn-anime-view:hover {
    background-color: var(--secondary-color) !important;
    border-color: var(--secondary-color) !important;
}

</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @foreach ($animes as $anime)
      <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
        <div class="card card-anime">
          <img src="{{ $anime->thumbnail_image }}" class="card-img-top img-fluid" alt="">
          <div class="card-body">
            <h1>
              {{$anime->title}}
              <a href="{{ route('anime.show', $anime->id) }}" class="btn btn-anime-view">Ver +</a>
            </h1>
            <p>{{$anime->description}}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
</div>
@endsection