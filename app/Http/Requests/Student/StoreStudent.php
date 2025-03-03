<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudent extends FormRequest
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
            "cpf" => "required|string",
            "course_id" => "required|integer",
            "group_id" => "required|integer",
            "modality" => "required|string",
            "payment" => "required|string",
            "name" => "string",
            "email" => "string",
            "birthdate" => "date",
            "phone" => "string",
            "identity" => "string",
            "cep" => "string",
            "address" => "string",
            "education" => "string",
            "graduate" => "string",
            "workspace" => "string",
            "discover" => "string",
            "google" => "boolean",
            "deficit" => "string|nullable",
        ];
    }
}
