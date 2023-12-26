<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Emp_InfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Fname'         => 'required|string|max:255',
            'Lname'         => 'required|string|max:255',
            'Email'         => 'required|string|email|max:255|unique:employer__infos',
        ];
    }
}
