<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class AnimeController extends Controller
{
    public function index()
    {
        $animes = Anime::all();
        return view('admin.anime.index', ['animes' => $animes] );
    }

    public function create()
    {
        return view('admin.anime.create' );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:animes'],
            'description' => ['required', 'string'],
            'cover_image' => ['required', 'image', 'max:2048'],
            'thumbnail_image' => ['required', 'image', 'max:2048'],
        ]);

        $coverImagePath = $request->file('cover_image')->store('public/animes/cover_images');
        $thumbnailImagePath = $request->file('thumbnail_image')->store('public/animes/thumbnail_images');

        $anime = new Anime([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'cover_image' => Storage::url($coverImagePath),
            'thumbnail_image' => Storage::url($thumbnailImagePath),
        ]);

        $anime->save();

        return redirect()->route('admin.anime.index')->with('success', 'Anime creado con éxito.');
    }

    public function edit(Anime $anime)
    {
        return view('admin.anime.edit', compact('anime'));
    }

    public function update(Request $request, Anime $anime)
    {
        // Validación
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Procesar y almacenar la imagen de portada y miniatura si se proporcionan
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '-' . $coverImage->getClientOriginalName();
            $coverImage->storeAs('public/anime-covers', $coverImageName);
            $anime->cover_image = 'anime-covers/' . $coverImageName;
        }

        if ($request->hasFile('thumbnail_image')) {
            $thumbnailImage = $request->file('thumbnail_image');
            $thumbnailImageName = time() . '-' . $thumbnailImage->getClientOriginalName();
            $thumbnailImage->storeAs('public/anime-thumbnails', $thumbnailImageName);
            $anime->thumbnail_image = 'anime-thumbnails/' . $thumbnailImageName;
        }

        // Actualizar campos
        $anime->title = $request->input('title');
        $anime->description = $request->input('description');

        // Guardar cambios
        $anime->save();

        // Redirigir al listado de animes
        return redirect()->route('admin.anime.index')->with('success', 'Anime updated successfully!');

    }



}
