<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    
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
            'password' => [
                'bail',
                'required',
                'confirmed',
                'string',
                'max:250',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                'current_password:web'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Password'
        ];
    }
}
