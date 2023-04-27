<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use App\Models\Rating;

class AnimeController extends Controller
{
    public function index()
    {
        $animes = Anime::all();
        // $platforms = $platforms;
        return view('index', ['animes' => $animes]);
    }

    public function show($id)
    {
        $anime = Anime::with('episodes.ratings')->findOrFail($id);
        return view('anime.show', compact('anime'));
    }

    public function storeRating(Request $request, $episode) {
        $request->validate([
            'episode_id' => 'required|exists:episodes,id',
            'rating' => 'required|integer|min:1|max:5'
        ]);
    
        // Obtener el ID del usuario autenticado
        $userId = auth()->id();
    
        // Verificar si el usuario ya calificó este episodio
        $existingRating = Rating::where('user_id', $userId)
                                ->where('episode_id', $request->episode_id)
                                ->first();
    
        if ($existingRating) {
            // Redirigir al usuario a la página de detalles del episodio con un mensaje de error
            return redirect()->route('anime.episodes', $request->anime_id)
                             ->withErrors(['rating' => 'Ya has calificado este episodio.']);
        }
    
        // Crear un nuevo registro en la tabla 'ratings'
        $rating = new Rating;
        $rating->episode_id = $request->episode_id;
        $rating->user_id = $userId;
        $rating->rating = $request->rating;
        $rating->save();

        // Redirigir al usuario a la página de detalles del episodio con un mensaje de éxito
        return redirect()->route('anime.episodes', $request->anime_id)
                        ->with('success', '¡Tu calificación ha sido guardada con éxito!');
    }
}
