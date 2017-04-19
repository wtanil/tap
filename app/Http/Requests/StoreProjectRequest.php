<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            
            'title' => 'required|max:200',
            'categoryId' => 'required',
            'projectDate' => 'required|date',
        ];
    }

    public function message()
    {
        return [
            'categoryId.required' => 'The category field is required.',
            'projectDate.required' => 'The project date field is required.',
        ];
    }
}
