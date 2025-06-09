<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public function toggle(Movie $movie)
    {
        $user = Auth::user();
   
        
        if ($user->likedMovies()->where('movie_id', $movie->id)->exists()) {
            $user->likedMovies()->detach($movie);
            $liked = false;
        } else {
            $user->likedMovies()->attach($movie);
            $liked = true;
        }
        
        return redirect()->back()->with('message', $liked ? 'Film aggiunto ai preferiti' : 'Film rimosso dai preferiti');
    }

}
