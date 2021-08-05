<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /* public function authorize()
    {
        return false;
    } */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:100', 'unique:users,username,'.$this->employee->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->employee->id],
            'phone' => ['required','numeric','digits_between:10,13'],
            'photo' => ['mimes:jpeg,jpg,png,svg','max:2048'],
            'company_id' => ['required'],
            'departement_id' => ['required'],
        ];
    }
}
