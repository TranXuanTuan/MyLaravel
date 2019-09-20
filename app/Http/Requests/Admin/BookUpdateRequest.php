<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
            'name' => 'required',
            'publisher' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'num_of_page' => 'required',
            'maxdate' => 'required',
            'num' => 'required',
            'summary' => '',
            'picture' => '',
        ];
    }
}
