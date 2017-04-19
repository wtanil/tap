<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'projectId' => 'required',
            'uploadedImage' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|max:200',
        ];
    }

    public function message()
    {
        return [
            'projectId.required' => 'Please try again.',
            'uploadedImage.required' => 'Please pick a file to upload.',
            'uploadedImage.mimes' => 'Not a valid file type. Valid types include jpeg, bmp and png.',
            'uploadedImage.max' => 'File size is too big.'
        ];
    }
}
