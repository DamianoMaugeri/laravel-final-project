@extends('layouts.movies')

@section('title')
{{$movie->title}}
@endsection

@section('content')

<div class="row">
    <div class="col-12 text-center p-4">
        {{$likesCount}}
    </div> 

    {{-- <div class="col-6 text-center p-4">
        {{$project->type->name}}
    </div> --}}

    {{-- <div class="col-6 text-center p-4">
        {{$project->team ? 'Progetto in collaborazione con un team ' : 'Progetto individuale'}}
    </div> --}}

    <div class="col-12 text-center p-4 ">
            Generi: 
            @forelse ($movie->genres as $genre)
            <span class="badge bg-warning" >{{$genre->name}}</span>
                
            @empty
            nessun genere disponibile.
                
            @endforelse
    

    </div>

    <div class="col-12 text-center p-4">
        {{$movie->description}}
    </div>
</div>
<div class="row">
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




<div class="row justify-content-center text-center">

    <div class="col-3"> 
        <a href={{route('movies.edit', $movie)}} class=" btn btn-primay bg-warning text-white ">Modifica il Film</a>
    </div>

    {{-- <div class="col-3">
         <a href={{route('projects.create')}} class=" btn btn-primay bg-danger text-white ">Elimina Progetto</a>
    </div> --}}

    <div class="col-3">
        <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
            Elimina il film
          </button>

    </div>


</div>

<div class="row">
    @if (Auth::check())
    <form action="{{ route('movies.reviews.store', $movie) }}" method="POST" class="row g-3">
        @csrf

        {{-- <textarea name="content" required></textarea> --}}

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


        {{-- <select name="rating">
            <option value="">Rating (facoltativo)</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select> --}}


        <button type="submit">Invia Recensione</button>
    </form>
@else
    <p><a href="{{ route('login') }}">Accedi</a> per scrivere una recensione.</p>
@endif
</div>


<div class="row">
    @foreach ($movie->reviews as $review)
    <div>
        <strong>{{ $review->user->name }}</strong>
        <p>{{ $review->content }}</p>
        <p>Rating: {{ $review->rating ?? 'N/A' }}</p>
        
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
</div>


    
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