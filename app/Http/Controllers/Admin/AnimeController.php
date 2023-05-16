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
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('public/animes/cover_images');
            $anime->cover_image = Storage::url($coverImagePath);
        }

        if ($request->hasFile('thumbnail_image')) {
            $thumbnailImagePath = $request->file('thumbnail_image')->store('public/animes/thumbnail_images');
            $anime->thumbnail_image = Storage::url($thumbnailImagePath);
        }

        $anime->title = $request->input('title');
        $anime->description = $request->input('description');

        $anime->save();

        return redirect()->route('admin.anime.index')->with('success', 'Anime updated successfully!');
    }




}
