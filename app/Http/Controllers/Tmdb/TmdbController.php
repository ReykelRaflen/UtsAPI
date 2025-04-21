<?php

namespace App\Http\Controllers\Tmdb;

use App\Http\Controllers\Controller;
use App\Services\TmdbService;
use Illuminate\Http\Request;

class TmdbController extends Controller
{
    protected $tmdb;

    public function __construct(TmdbService $tmdb)
    {
        $this->tmdb = $tmdb;
    }

    public function getPopular()
    {
        $data = $this->tmdb->getPopularMovies();
        $movies = $data['results'] ?? [];
        $error = $data['error'] ?? null;

        return view('movies', compact('movies', 'error'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $data = $this->tmdb->searchMovies($query);
        $movies = $data['results'] ?? [];
        $error = $data['error'] ?? null;

        return view('movies', compact('movies', 'error'));
    }
}
