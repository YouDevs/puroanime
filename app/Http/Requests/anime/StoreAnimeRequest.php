<?php

namespace App\Http\Requests\anime;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $validation = [
            'title'           => 'required|string|max:255|unique:animes,title',
            'description'     => 'required|string|max:255',
            'cover_image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        if($this->isMethod('put')) {
            $validation['id']    = 'required|int|min:1|max:999999|exists:animes,id';
            $validation['title'] = $validation['title'].",{$this->id}";
        }

        return $validation;
    }
}
