@extends('layouts.app')

@section('styles')
<style>
.rating {
    display: inline-flex;
    flex-direction: row-reverse;
    justify-content: center;
    align-items: center;
    font-size: 1.5em;
}

.rating-input {
    display: none;
}

.rating-star {
    position: relative;
    padding: 0 3px;
    cursor: pointer;
    transition: color 0.2s;
}

.rating-input:checked ~ .rating-star {
    color: #ffc107;
}

.rating-input:hover ~ .rating-star {
    color: #ffc107;
}

.hero-banner {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 50vh;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
}

.hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
}

.streaming-platforms {
    list-style-type: none;
    padding: 0;
}

.streaming-platforms li {
    display: inline-block;
    margin-right: 15px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}


</style>
@endsection

@section('content')
<div class="container">
    <div class="hero-banner" style="background-image: url('{{$anime->cover_image}}');">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
          <h1 class="fs-1">{{$anime->title}}</h1>
          <p class="fs-4">{{$anime->description}}</p>
          <div class="mt-4">
            @php
                $platforms = json_decode($anime->streaming_platforms);
            @endphp
            @if ($platforms)
                <h3>Disponible en:</h3>
                <ul class="streaming-platforms">
                    @foreach($platforms as $platform)
                        <li>{{$platform}}</li>
                    @endforeach
                </ul>
            @endif
          </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h2>Episodios</h2>
            <table class="table table-responsive color-light">
                <thead>
                    <tr>
                        <th>Episodio</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Calificación promedio</th>
                        <th>Calificar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anime->episodes as $episode)
                        <tr>
                            <td>{{ $episode->episode_number }}</td>
                            <td>{{ $episode->title }}</td>
                            <td>
                                @if ($episode->type == 'canon')
                                    <p class="color-success fw-bold">{{ ucfirst($episode->type) }}</p>
                                @elseif($episode->type == 'filler')
                                    <p class="color-danger fw-bold">
                                        Relleno
                                    </p>
                                @else
                                    <p class="color-blue fw-bold">
                                       Mixto
                                    </p>
                                @endif
                            </td>
                            <td>{{ $episode->ratings->avg('rating') }}</td>
                            <td>
                                {{-- Aquí puedes agregar el formulario para calificar el episodio --}}
                                <form method="POST" action="{{route('anime.rating.store', $episode)}}">
                                    @csrf
                                    <input type="hidden" name="anime_id" value="{{$anime->id}}">
                                    <input type="hidden" name="episode_id" value="{{$episode->id}}">
                                        @php
                                            $rating = $episode->ratings()->where('user_id', Auth::id())->first();
                                        @endphp
                                    <div class="rating">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="rating" id="rating-{{$episode->id}}-{{$i}}" value="{{$i}}" class="rating-input" {{ $rating && $rating->rating == $i ? 'checked' : '' }}>
                                            <label for="rating-{{$episode->id}}-{{$i}}" class="rating-star"><i class="fas fa-star"></i></label>
                                        @endfor
                                    </div>
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

@section('scripts')
<script>
document.querySelectorAll('.rating-input').forEach(input => {
    console.log("llega!")
    input.addEventListener('change', () => {
        input.closest('form').submit();
    });
});
</script>
@endsection