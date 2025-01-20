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
            "name" => "required|string",
            "email" => "required|string",
            "birthdate" => "required|date",
            "phone" => "required|string",
            "identity" => "required|string",
            "cpf" => "required|string",
            "cep" => "required|string",
            "address" => "required|string",
            "education" => "required|string",
            "graduate" => "required|string",
            "workspace" => "required|string",
            "course_id" => "required|integer",
            "group_id" => "required|integer",
            "modality" => "required|string",
            "payment" => "required|string",
            "discover" => "required|string",
            "google" => "required|boolean",
            "deficit" => "string|nullable",
        ];
    }
}
