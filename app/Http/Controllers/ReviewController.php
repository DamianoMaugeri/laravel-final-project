<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ReviewController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Movie $movie)
    {
        //
        $request->validate([
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $review = new Review([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        $review->user()->associate(Auth::user());
        $review->movie()->associate($movie);
        $review->save();

        return redirect()->route('movies.show', $movie)->with('success', 'Recensione aggiunta con successo!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie, $reviewId)
    {
        //
        $review = $movie->reviews()->findOrFail($reviewId);
        $this->authorize('update', $review);

        return view('reviews.edit', compact('review', 'movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie, $reviewId)
    {
        //

        $review = $movie->reviews()->findOrFail($reviewId);
        $this->authorize('update', $review);

        $request->validate([
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $review->update($request->only('content', 'rating'));

        return redirect()->route('movies.show', $review->movie)->with('success', 'Recensione aggiornata!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie, $reviewId)
    {
        //
        $review = $movie->reviews()->findOrFail($reviewId);
        $this->authorize('delete', $review);

        $movie = $review->movie;

        $review->delete();

        return redirect()->route('movies.show', $movie)->with('success', 'Recensione eliminata.');
    
    }
}
