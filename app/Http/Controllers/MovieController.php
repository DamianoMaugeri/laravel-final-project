<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $movies = Movie::all();

        return view("movies.index", compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // prendiamo tutti i generi 
        $genres = Genre::all();
        return view("movies.create", compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $newMovie= new Movie();
        $newMovie->title=$data['title'];
        $newMovie->description=$data['description'];
        $newMovie->director=$data['director'];
        $newMovie->year=$data['year'];

        // aggiungere controlli per la presenza di immagini 
       // $newMovie->title=$data['title'];

        // aggiungere controlli per la presenza di video 
       // $newMovie->title=$data['title'];

       return  redirect()-> route('movies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
        $likesCount = $movie->likedByUsers()->count();
        return view("movies.show", compact('movie','likesCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
        $genres = Genre::all();
        return view('movies.edit',compact('movie','genres'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
        $data= $request->all();
       
        $movie->title=$data['title'];
        $movie->description=$data['description'];
        $movie->director=$data['director'];
        $movie->year=$data['year'];

        $movie->update();

        if ($request->has('genres')) $movie->genres()->sync($data['genres']);

        else $movie->technologies()->detach();





        // if ($request->has('image')) $movie->image = $data['image'];

        // else $movie->technologies()->detach();

        // if ($request->has('video')) $movie->video = $data['video'];

        // else $movie->technologies()->detach();



        return  redirect()-> route('movies.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
        $movie->delete();
        return  redirect()-> route('movies.index');
    }
}
