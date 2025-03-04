<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroup extends FormRequest
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
            "start" => "date",
            "end" => "date",
            "price" => "integer",
            "course_id" => "integer",
            "teacher" => "string",
            "inCompany" => "boolean",
            "frequency" => "array",
            "modalities" => "array",
        ];
    }
}
