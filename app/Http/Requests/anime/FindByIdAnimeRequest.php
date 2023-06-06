<?php

namespace App\Http\Requests\anime;

use Illuminate\Foundation\Http\FormRequest;

class FindByIdAnimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|min:1|max:999999|exists:animes,id',
        ];
    }
}
