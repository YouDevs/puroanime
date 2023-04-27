<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anime;
use App\Models\Episode;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Anime $anime)
    {
        $episodes = $anime->episodes;
        return view('admin.episodes.index', compact('episodes', 'anime'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Anime $anime)
    {
        return view('admin.episodes.create', compact('anime'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Anime $anime)
    {
        $request->validate([
            'title' => 'required',
            'episode_number' => 'required|integer',
            'summary' => 'required',
            'air_date' => 'required|date',
            'type' => 'required|in:canon,filler,mixed',
        ]);

        $episode = new Episode($request->all());
        $anime->episodes()->save($episode);

        return redirect()->route('episodes.index', $anime)->with('success', 'Episodio creado con éxito.');
    }

   /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anime $anime, Episode $episode)
    {
        return view('admin.episodes.edit', compact('anime', 'episode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anime $anime, Episode $episode)
    {
        $request->validate([
            'title' => 'required',
            'episode_number' => 'required|integer',
            'summary' => 'required',
            'air_date' => 'required|date',
            'type' => 'required|in:canon,filler,mixed',
        ]);

        $episode->update($request->all());

        return redirect()->route('episodes.index', $anime)->with('success', 'Episodio actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anime $anime, Episode $episode)
    {
        $episode->delete();

        return redirect()->route('episodes.index', $anime)->with('success', 'Episodio eliminado con éxito.');
    }

}
