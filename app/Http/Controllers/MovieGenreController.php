<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovie_GenreRequest;
use App\Http\Requests\UpdateMovie_GenreRequest;
use App\Models\Movie_Genre;

class MovieGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovie_GenreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovie_GenreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie_Genre  $movie_Genre
     * @return \Illuminate\Http\Response
     */
    public function show(Movie_Genre $movie_Genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie_Genre  $movie_Genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie_Genre $movie_Genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovie_GenreRequest  $request
     * @param  \App\Models\Movie_Genre  $movie_Genre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovie_GenreRequest $request, Movie_Genre $movie_Genre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie_Genre  $movie_Genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie_Genre $movie_Genre)
    {
        //
    }
}
