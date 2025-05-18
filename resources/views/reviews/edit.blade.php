@extends('layouts.movies')

@section('title', 'modifica la recensione')

@section('content')


<div class="row p-4 justify-content-center">

    {{-- <a href={{route('projects.create')}} class=" btn btn-primay col-3 bg-primary text-white ">Aggiungi un nuovo Progetto</a> --}}

</div>



<div class="row row-gap-4">

    
        @if (Auth::check())
        <form action="{{ route('movies.reviews.update', [$movie,$review]) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')
    
            {{-- <textarea name="content" required></textarea> --}}
    
            <div class="col-12">
                <label for="content" class="form-label">Scrivi la tua recensione </label>
               <textarea name="content" id="content"  rows="5" class="form-control" required>{{$review->content}}</textarea>
            </div>
    
            <div class="col-12">
                <label for="rating" class="form-label">Dai la tua valutazione</label>
              <select name="rating" id="rating" class="form-select">
                @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{$review->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
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

    
@endsection