<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTranslationRequest extends FormRequest
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
            'name' => 'required|string|max:250',
            'link' => 'required|string|max:250',
            'articleBody' => 'required|string',
            'gender' => 'required|string|max:250',
            'nationality' => 'required|string|max:250',
            'letter' => 'required|string|max:5',
            'religion' => 'string|max:250',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'link' => 'Link',
            'articleBody' => 'Article Body',
            'gender' => 'Gender',
            'nationality' => 'Nationality',
            'letter' => 'Letter',
            'religion' => 'Religion',
        ];
    }
}
