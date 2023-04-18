@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @foreach ($animes as $anime)
      <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
        <div class="card card-anime">
          <img src="{{asset('images/naruto-shippuden.webp')}}" class="card-img-top img-fluid" alt="">
          <div class="card-body">
            <h1>{{$anime->title}}</h1>
            <p>{{$anime->description}}</p>
            <div class="streaming-platforms">
                @php
                  $platforms = json_decode($anime->streaming_platforms);
                @endphp
                @foreach($platforms as $platform)
                  <a href="#" class="platform">{{ $platform }}</a>
                @endforeach
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
</div>
@endsection