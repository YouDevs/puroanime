<?php

namespace App\Http\Controllers\Admin;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\anime\StoreAnimeRequest;
use App\Http\Requests\anime\FindByIdAnimeRequest;

class AnimeController extends Controller
{
    protected $model;

    public function __construct(Anime $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $animes = $this->model::all();
        return view('admin.anime.index', ['animes' => $animes] );
    }

    public function create()
    {
        return view('admin.anime.create' );
    }

    public function store(StoreAnimeRequest $request)
    {
        $params = $request->validated();

        $coverImagePath = $request->file('cover_image')->store('public/animes/cover_images');
        $thumbnailImagePath = $request->file('thumbnail_image')->store('public/animes/thumbnail_images');

        $anime = $this->model->create([
            'title' => $params['title'],
            'description' => $params['description'],
            'cover_image' => Storage::url($coverImagePath),
            'thumbnail_image' => Storage::url($thumbnailImagePath),
        ]);

        $anime->save();
        return redirect()->route('admin.anime.index')->with('success', 'Anime creado con éxito.');
    }

    public function edit($id)
    {
        $anime = $this->model::find($id);
        return view('admin.anime.edit', compact('anime'));
    }

    public function update(StoreAnimeRequest $request)
    {
        $params = $request->validated();

        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('public/animes/cover_images');
            $coverImage = Storage::url($coverImagePath);
        }

        if ($request->hasFile('thumbnail_image')) {
            $thumbnailImagePath = $request->file('thumbnail_image')->store('public/animes/thumbnail_images');
            $thumbnailImage = Storage::url($thumbnailImagePath);
        }

        $this->model::where('id', $params['id'])->update([
            'title' => $params['title'],
            'description' => $params['description'],
            'cover_image' => Storage::url($coverImage),
            'thumbnail_image' => Storage::url($thumbnailImage),
        ]);     

        return redirect()->route('admin.anime.index')->with('success', 'Anime updated successfully!');
    }

    public function destroy(FindByIdAnimeRequest $request) {
        $params = $request->validated();

        $anime = $this->model::where('id', $params['id'])->delete();
        if($anime) {
            return redirect()->route('admin.anime.index')->with('success', 'Anime deleted successfully!');
        }
    }
}
