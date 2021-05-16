<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'user_id' => 'required',
            'phone' => 'required|min:11|max:15',
            'country_id' => 'required',
            'city_id' => 'required',
            'birth_date' => 'required',
            'avatar' => ''
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id' => 'The user id is required',
            'country_id' => 'The country id is required',
            'city_id' => 'The city id is required',
            'phone' => 'The phone is required',
            'birth_date' => 'The user id is required',
        ];
    }
}
