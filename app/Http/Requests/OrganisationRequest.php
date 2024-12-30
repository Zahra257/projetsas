<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganisationRequest extends FormRequest
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
        $method = $this->method(); // Get the HTTP method

        $activation_date = ($method === 'PUT') ? 'required|date' : 'nullable';
        $first_activation_date  = ($method === 'PUT') ? 'nullable' : 'required|date' ;

        return [
            'name' => 'required|string',
            'code' => 'required|string|max:20|unique:organisations,code,'. $this->route('id'),
            'first_activation_date' =>$first_activation_date,
            'activation_date' => $activation_date,
            'expiration_date' => 'required|date|after:first_activation_date',
        ];
    }
}
