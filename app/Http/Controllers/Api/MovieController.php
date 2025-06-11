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



        $query = Movie::query();

        // has controlla che sia presente ma può essere anche null o vuoto , in alternativa posso usare ->filled() che controlla che non sia vuoto  o null

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    
        $movies = $query->get();

            // Film più recenti
        $recentMovies = Movie::orderByDesc('year')->limit(10)->get();

          
        $likedMovies = null;
        $recommendedMovies = Movie::withCount('likedByUsers')
        ->orderBy('liked_by_users_count', 'desc')
        ->limit(10)
        ->get();

    

        return response()->json([
            'success'=> true,
            'movies' => $movies,
            'recent' => $recentMovies,
            'liked' => $likedMovies,
            'recommended' => $recommendedMovies,
        ]);
    


    }

    public function show(Movie $movie){

        
        $movie->load('genres','likedByUsers', 'reviews.user')->loadCount('likedByUsers');




        return response()->json([
            "success" => true,
            "data"=> $movie
        ]);

    }


    // public function stream(){

    // }





}
