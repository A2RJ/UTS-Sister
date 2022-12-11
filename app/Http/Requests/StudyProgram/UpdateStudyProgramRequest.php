<?php

namespace App\Http\Requests\StudyProgram;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudyProgramRequest extends FormRequest
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
            'study_program' => ['required'],
            'faculty_id' => ['required'],
            'sdm_id_admin' => ['required']
        ];
    }
}
