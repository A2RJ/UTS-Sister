<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'subject' => ['required'],
            'sks' => ['required', 'numeric'],
            'number_of_meetings' => ['required', 'numeric'],
            'structure_id' => ['required'],
            'class_id' => ['required'],
            'sdm_id' => ['required'],
        ];
    }
}
