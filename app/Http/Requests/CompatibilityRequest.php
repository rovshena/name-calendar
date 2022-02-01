<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompatibilityRequest extends FormRequest
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
        $rules = [];

        if ($this->isMethod('POST')) {
            $rules = array_merge($rules, [
                'first_id' => 'required|exists:App\Models\Translation,id',
                'second_id' => 'required|exists:App\Models\Translation,id',
            ]);
        } elseif ($this->isMethod('PUT')) {
            $rules = array_merge($rules, [
                'compatibility' => 'required|numeric|min:0|max:100',
                'content' => 'required|string|nullable',
            ]);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'first_id' => 'First Name',
            'second_id' => 'Second Name',
            'compatibility' => 'Compatibility',
            'content' => 'Content'
        ];
    }
}
