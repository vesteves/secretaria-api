<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudent extends FormRequest
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
            "name" => "string",
            "email" => "string",
            "birthdate" => "date",
            "phone" => "string",
            "identity" => "string",
            "cpf" => "string",
            "cep" => "string",
            "address" => "string",
            "education" => "string",
            "graduate" => "string",
            "workspace" => "string",
            "course_id" => "integer",
            "group_id" => "integer",
            "modality" => "string",
            "payment" => "string",
            "discover" => "string",
            "google" => "boolean",
            "deficit" => "string|nullable",
        ];
    }
}
