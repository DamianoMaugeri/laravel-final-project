@extends('layouts.movies')

@section('title', 'Modifica il Film ')

@section('content')

 

    <form action="{{route("movies.update", $movie)}}" method="POST"  enctype="multipart/form-data" class="row g-3">

        @csrf
        @method('PUT')


        <div class="col-md-6">
          <label for="title" class="form-label">Titolo del film</label>
          <input type="text" class="form-control" id="title" name="title" value="{{$movie->title}}">
        </div>

        <div class="col-md-6">
          <label for="director" class="form-label">Regista </label>
          <input type="text" class="form-control" id="director" name="director" value="{{$movie->director}}">
        </div> 

        {{-- <div class="col-md-6">
            <label for="director" class="form-label">Anno di uscita  </label>
            <input type="text" class="form-control" id="director" name="director">
        </div>  --}}


        <div class="col-md-6">
            <label for="year" class="form-label">Anno di uscita</label>
            <select name="year" id="year" class="form-select">
                 @for ($year = now()->year; $year >= 1900; $year--)
                     <option value="{{ $year }}" {{$movie->year == $year ? 'selected' : '' }}>{{ $year }}</option>
                 @endfor

            </select>
        </div>

        <div class="col-md-12 d-flex flex-wrap gap-3">

            @foreach ($genres as $genre)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="genres[]" value="{{$genre->id}}" id="genre-{{$genre->id}}"  {{$movie->genres->contains($genre) ? 'checked': ''}}>
                <label class="form-check-label" for="genre-{{$genre->id}}">{{$genre->name}}</label>
            </div>
                
            @endforeach


        </div>

        <div class="col-12">
            <label for="image" class="form-label">Immagine:</label>
            <input type="file" name="image" id="image">

            @if ($movie->image)

                    <img class="img-fluid w-30" src="{{asset("storage/".$movie->image)}}" alt="{{$movie->title}}">

            @endif
        </div>

        <div class="col-12">
          <label for="description" class="form-label">Descrizione del progetto </label>
         <textarea name="description" id="description"  rows="5" class="form-control">{{$movie->description}}</textarea>
        </div>

        <div class="col-2 ">
            <input type="submit" value="Salva" class="btn btn-primary ">

        </div>
      
      </form>
    

    
@endsection