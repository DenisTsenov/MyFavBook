<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'isbn'        => 'required|isbn',
            'description' => 'required|string',
            'image'       => 'required|file|max:10240|mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=200',
        ];
    }
}
