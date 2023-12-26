<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request_AppRequest extends FormRequest
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
        if( request()->routeIs('rapp.store')) {
            return [
                'job_id'    =>'required|integer',
                'Document'  => 'required|image|mimes:jpg,bmp,png|max:2048',
                
            ];
          }
          else if( request()->routeIs('rapp.update')) {
            return [
                'status' => 'required|in:processing,approve,reject',
               
            ];
          }
          return []; // Ensure there's a default return
    }
}
