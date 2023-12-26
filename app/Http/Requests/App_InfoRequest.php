<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class App_InfoRequest extends FormRequest
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
            'Age'           => 'required|integer|max:100',
            'Gender'        => 'required|string|in:Male,Female,Other|max:255', // Add an 'in' rule for specific values
            'Email'         => 'required|string|email|max:255|unique:applicant_infos', // Check for unique email in the 'users' table
            'Address'       => 'required|string|max:255',
            'Birth_date'    => 'required|date_format:d-m-Y|max:255',
        ];
    }
}
