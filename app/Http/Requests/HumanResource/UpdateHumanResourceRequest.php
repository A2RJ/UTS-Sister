<?php

namespace App\Http\Requests\HumanResource;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHumanResourceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "sdm_name" => ['required'],
            "nidn" => ['nullable', 'numeric'],
            "nip" => ['nullable', 'numeric'],
            "active_status_name" => ['required'],
            "employee_status" => ['required'],
            "sdm_type" => ['required'],
            "is_sister_exist" => ['boolean'],
            "faculty_id" => ['nullable', 'numeric'],
            "study_program_id" => ['nullable', 'numeric'],
            "structure_id" => ['nullable', 'numeric'],
        ];
    }
}
