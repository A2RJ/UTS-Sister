<?php

namespace App\Http\Requests\Wr3;

use Illuminate\Foundation\Http\FormRequest;

class LecturerDetailRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'faculty' => 'required',
            'study_program' => 'required',
            'expertise' => 'required',
            'theme' => 'required',
            'other_theme' => $this->theme == 'Lain-lain' ? 'required' : 'nullable',
        ];
    }
}
