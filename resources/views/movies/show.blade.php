@extends('layouts.movies')

{{-- @section('title')
{{$movie->title}}
@endsection --}}

@section('content')

<div class="row">

    <div class="col-6">
        <h1>
            {{$movie->title}}
        </h1>
    </div>

    
    <div class="col-6 text-center">
        <div class="d-flex justify-content-center gap-3">
            <div>
                Totale dei Like : {{$likesCount}}
            </div>

            <div>
                <form action="{{ route('movies.like', $movie->id) }}" method="POST">
                     @csrf

                    <button type="submit" class="btn btn-sm btn-outline-primary">

                     @if (auth()->user() && auth()->user()->likedMovies->contains($movie->id))
                        ❤️ Unlike
                    @else
                        🤍 Like
                    @endif
                    </button>
                </form>
            </div>
        </div>
    </div> 



    <div class="col-6">
        <div class="d-flex flex-column gap-4">

            <div class="col-12">
                Generi: 
                @forelse ($movie->genres as $genre)
                <span class="badge bg-primary" >{{$genre->name}}</span>
                
                @empty
                nessun genere disponibile.
                @endforelse
    
            </div>

            <div class="col-12">
                Regista: {{$movie->director}}
            </div>

            <div class="col-12">
                Anno di uscita: {{$movie->year}}
            </div>

            <div class="col-12">
                {{$movie->description}}
            </div>
        </div>
    </div>
    
    @if ($movie->image)
        
    <div class="col-6 text-center">
        <figure>
            <img src="{{asset("storage/".$movie->image)}}" alt="{{$movie->title}}">
        </figure>
    </div>
    @endif

    
    <div class="col-12 d-flex justify-content-start ">
        <div class="col-2"> 
            <a href={{route('movies.edit', $movie)}} class=" btn btn-warning text-white ">Modifica il Film</a>
        </div>

        <div class="col-2">
            <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
                Elimina il film
            </button>

        </div>
    </div> 
    
</div>







<div class="col-12 col-md-6  bg-dark-subtle p-5 my-5">

    @if (Auth::check())
        <form action="{{ route('movies.reviews.store', $movie) }}" method="POST" class="row g-3">

            @csrf

            <div class="col-12">
                <label for="content" class="form-label">Scrivi la tua recensione </label>
            <textarea name="content" id="content"  rows="5" class="form-control" required></textarea>
            </div>

            <div class="col-12">
                <label for="rating" class="form-label">Dai la tua valutazione</label>
            <select name="rating" id="rating" class="form-select">
                @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
            </select>
            </div>
            <button class="btn btn-primary" type="submit">Invia Recensione</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Accedi</a> per scrivere una recensione.</p>
    @endif

</div>



<div class="col-12">

    <h2>Recensioni: </h2>

    <div class="d-flex flex-wrap">
        @foreach ($movie->reviews as $review)
            <div class="col-12 my-4 bg-info-subtle p-4">
                <strong>{{ $review->user->name }}</strong>
                <p>{{ $review->content }}</p>
                <p>Rating: {{ $review->rating ?? 'N/A' }}</p>

                <div class="d-flex flex-wrap gap-3">

                    @can('update', $review)
                        <div class="col-3 col-sm-2 col-md-2 col-lg-1">
                            <a class="btn btn-outline-warning" href="{{ route('movies.reviews.edit', [$movie, $review]) }}">Modifica</a>

                        </div>
                    @endcan
    
                    @can('delete', $review)

                        <div class="col-3 col-sm-2 col-md-2 col-lg-1">

                            <form action="{{ route('movies.reviews.destroy', [$movie, $review]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger">Elimina</button>
                            </form>
                        </div>
                    @endcan
                </div>
        
            </div>
        @endforeach

    </div>



</div>

{{-- 
<div class="row">
    @foreach ($movie->reviews as $review)
    <div>
        <strong>{{ $review->user->name }}</strong>
        <p>{{ $review->content }}</p>
        <p>Rating: {{ $review->rating ?? 'N/A' }}</p>


        <div>
            <div class="col-2">

            </div>

            <div class="col-2"> 
                <a href={{route('movies.edit', $movie)}} class=" btn btn-warning text-white ">Modifica il Film</a>
            </div>
        </div>
        
        @can('update', $review)
            <a href="{{ route('movies.reviews.edit', [$movie, $review]) }}">Modifica</a>
        @endcan

        @can('delete', $review)
            <form action="{{ route('movies.reviews.destroy', [$movie, $review]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Elimina</button>
            </form>
        @endcan
    </div>
@endforeach
</div> --}}


    
@endsection


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina il film </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Il film sarà eliminato definitivamente
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">indietro</button>
       
          <form action="{{route('movies.destroy', $movie )}} " method="POST">
            @csrf
            @method('DELETE')

            <input type="submit" class="btn btn-danger" value="Elimina definitivamente">
          </form>
        </div>
      </div>
    </div>
  </div>