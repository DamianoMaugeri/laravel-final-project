<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    //

    public function index(Request $request){


        // $movies = Movie::with('genres', 'likedByUsers')->get();

        // return response()->json([
        //     "success" => true,
        //     "data"=> $movies
        // ]);

        $query = Movie::query();

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    
        $movies = $query->get();

            // Film più recenti
        $recentMovies = Movie::orderByDesc('year')->limit(10)->get();

            // Se l'utente è autenticato, includi likes e suggerimenti
        $likedMovies = null;
        $recommendedMovies = null;

    
        // Se l'utente è autenticato
        if (Auth::check()) {
            $user = Auth::user();
    
            // Film che ha messo tra i preferiti
            $likedMovies = $user->likedMovies()
            ->withCount('likedByUsers')
            ->orderByDesc('liked_by_users_count')
            ->limit(10)
            ->get();
    
            // Esempio banale: film consigliati = film dello stesso genere dei film che ha likato
            $genreIds = $likedMovies->pluck('genres')->flatten()->pluck('id')->unique();
    
            $recommendedMovies = Movie::whereHas('genres', function ($q) use ($genreIds) {
                $q->whereIn('genres.id', $genreIds);
            })->whereNotIn('id', $likedMovies->pluck('id')) // escludi quelli già likati
              ->limit(10)->get();
    
            // return response()->json([
            //     'success'=> true,
            //     'movies' => $movies,
            //     'liked' => $likedMovies,
            //     'recommended' => $recommendedMovies,
            // ]);
        }

        return response()->json([
            'success'=> true,
            'movies' => $movies,
            'recent' => $recentMovies,
            'liked' => $likedMovies,
            'recommended' => $recommendedMovies,
        ]);
    
        // Se non è loggato
        // return response()->json([
        //     'movies' => $movies
        // ]);

    }

    public function show(Movie $movie){

        
        $movie->load('genres','likedByUsers', 'reviews');



        return response()->json([
            "success" => true,
            "data"=> $movie
        ]);

    }


    // public function stream(){

    // }





}
