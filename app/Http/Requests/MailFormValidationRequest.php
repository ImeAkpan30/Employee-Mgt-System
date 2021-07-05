<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailFormValidationRequest extends FormRequest
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
            'email' => 'required|string',
            'subject' => 'required|min:2|max:150',
            'message' => 'required|min:0|max:10000',
            'attachment' => 'image|mimes:jpeg,png,jpg,svg,docx,pdf,xlx|nullable'
        ];
    }

    public function messages()
    {
        $messages = [
            'email.required' => 'Hey whats up, this is my custom message.',
            'email.email' => 'That email does not look real.',
            'subject.main' => 'Minimum length required is 2.',
            'message' => 'required|min:0|max:10000',
            'attachment' => 'image|mimes:jpeg,png,jpg,svg,docx,pdf,xlx|nullable'
        ];

        return $messages;
    }
}
