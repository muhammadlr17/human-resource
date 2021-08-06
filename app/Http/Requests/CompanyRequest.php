<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:50|unique:companies',
            'logo' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048|dimensions:min_width=100,min_height=100',
            'website_url' => 'required|url|unique:companies,website_url',
        ];
    }
}
