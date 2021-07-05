<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'emergency_contact' => 'required',
            'cities_id' => 'required',
            'states_id' => 'required',
            'countries_id' => 'required',
            'companies_id' => 'required',
            'zip' => 'required',
            'job_type' => 'required',
            'age' => 'required',
            'birthdate' => 'required',
            'date_hired' => 'required',
            'departments_id' => 'required',
            'divisions_id' => 'required',
            'picture' => 'required',
        ];
    }
}
