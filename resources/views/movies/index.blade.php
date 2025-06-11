@extends('layouts.movies')

@section('title', 'Tutti i Film ')

@section('content')


<div class="row p-4 justify-content-center">

     <a href={{route('movies.create')}} class=" btn btn-primay col-3 bg-primary text-white ">Aggiungi un nuovo film</a>

</div>



<div class="row row-gap-4 my-5">


    @foreach ($movies as $movie)
    <div class="col-4 ">
        <a href="{{ route('movies.show', $movie) }}" class="text-decoration-none text-reset">
            <div class="card py-3">
                <div class="card-title text-center">
                    {{ $movie->title }}
                </div>
                {{-- <div class="card-body text-center">
                    
                    @forelse ($movie->technologies as $technology)
                    <span class="badge " style="background-color: {{$technology->color}}">{{$technology->name}}</span>
                        
                    @empty
                    nessuna tecnologia usata.
                        
                    @endforelse
                </div> --}}
            </div>
        </a>
    </div>
    @endforeach

</div>

    
@endsection