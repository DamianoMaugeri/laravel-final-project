@extends('layouts.movies')

@section('title', 'Tutti i Film: ')

@section('content')


<div class="row p-3 justify-content-center">

     <a href={{route('movies.create')}} class=" btn btn-primay col-3 bg-primary text-white ">Aggiungi un nuovo film</a>

</div>



<div class="row row-gap-4 my-5">




 @foreach ($movies as $movie)
  <div class="col-12 col-sm-6 col-md-4 mb-4">
    <div class="card h-100 shadow-sm">

      <div class="card-img-top overflow-hidden" style="height: 300px;">
        @if($movie->image)
          <img
            src="{{ asset('storage/' . $movie->image) }}"
            alt="{{ $movie->title }}"
            class="w-100 h-100"    
            style="object-fit: cover;">
        @else
          <img
            src="https://via.placeholder.com/600x900?text=No+Image"
            alt="No image"
            class="w-100 h-100"
            style="object-fit: cover;">
        @endif
      </div>

      <div class="card-body d-flex flex-column">
        <h5 class="card-title text-center mb-3">{{ $movie->title }}</h5>
        <div class="mb-3 text-center">
          @forelse ($movie->genres as $genre)
            <span class="badge rounded-pill bg-primary me-1">{{ $genre->name }}</span>
          @empty
            <span class="text-muted">Nessun genere associato</span>
          @endforelse
        </div>
        <a href="{{ route('movies.show', $movie) }}" class="btn btn-outline-dark mt-auto">Dettagli</a>
      </div>

    </div>
  </div>
@endforeach

</div>

    
@endsection