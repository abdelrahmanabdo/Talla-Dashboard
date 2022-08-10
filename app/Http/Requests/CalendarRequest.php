<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CalendarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check() ? backpack_auth()->check() : true;
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
        'event_name' => 'required',
        'event_id' => 'required',
        'date' => 'required',
        'type' => 'required'
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
          'user_id.required' => 'User id is required',
          'event_name.required' => 'Event name is required',
          'event_id.required' => 'Event id is required',
          'date.required' => 'Date is required',
          'type.required' => 'Type is required',
        ];
    }
}
