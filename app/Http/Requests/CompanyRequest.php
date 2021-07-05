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
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required',
            'company_email' => 'required',
            'company_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'company_phone' => 'required',
            'company_website' => 'required',
            'no_of_employees' => 'required',
            'services' => 'required',
            'company_logo' => 'image|mimes:jpeg,png,svg,jpg|nullable',
        ];
    }
}
