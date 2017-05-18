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

        'uploadedImage1' => 'image|mimes:jpeg,png,jpg|max:2048',
        'description1' => 'required_with:uploadedImage1|max:200',

        'uploadedImage2' => 'image|mimes:jpeg,png,jpg|max:2048',
        'description2' => 'required_with:uploadedImage2|max:200',

        'uploadedImage3' => 'image|mimes:jpeg,png,jpg|max:2048',
        'description3' => 'required_with:uploadedImage3|max:200',

        'uploadedImage4' => 'image|mimes:jpeg,png,jpg|max:2048',
        'description4' => 'required_with:uploadedImage4|max:200',

        'uploadedImage5' => 'image|mimes:jpeg,png,jpg|max:2048',
        'description5' => 'required_with:uploadedImage5|max:200',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
        'projectId.required' => 'Please try again.',

        'uploadedImage1.image' => 'Image 1 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage1.mimes' => 'Image 1 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage1.max' => 'Image 1 file size is too big. Max: 2MB',
        'description1.required_with' => 'The description field is required when image 1 is present.',
        'description1.max' => 'The description field for image 1 has too many characters. Max: 200 characters',

        'uploadedImage2.image' => 'Image 2 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage2.mimes' => 'Image 2 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage2.max' => 'Image 2 file size is too big. Max: 2MB',
        'description2.required_with' => 'The description field is required when image 2 is present.',
        'description2.max' => 'The description field for image 2 has too many characters. Max: 200 characters',

        'uploadedImage3.image' => 'Image 3 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage3.mimes' => 'Image 3 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage3.max' => 'Image 3 file size is too big. Max: 2MB',
        'description3.required_with' => 'The description field is required when image 3 is present.',
        'description3.max' => 'The description field for image 3 has too many characters. Max: 200 characters',

        'uploadedImage4.image' => 'Image 4 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage4.mimes' => 'Image 4 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage4.max' => 'Image 4 file size is too big. Max: 2MB',
        'description4.required_with' => 'The description field is required when image 4 is present.',
        'description4.max' => 'The description field for image 4 has too many characters. Max: 200 characters',

        'uploadedImage5.image' => 'Image 5 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage5.mimes' => 'Image 5 does not have a valid file type. Valid types include jpeg, bmp and png.',
        'uploadedImage5.max' => 'Image 5 file size is too big. Max: 2MB',
        'description5.required_with' => 'The description field is required when image 5 is present.',
        'description5.max' => 'The description field for image 5 has too many characters. Max: 200 characters',
        ];
    }
}















