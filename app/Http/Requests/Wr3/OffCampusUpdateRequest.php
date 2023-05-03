<?php

namespace App\Http\Requests\Wr3;

use Illuminate\Foundation\Http\FormRequest;

class OffCampusUpdateRequest extends FormRequest
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
            'title' => 'required',
            'location' => 'required',
            'performance_certificate' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'budget_source' => 'required',
            'funding_amount' => 'required',
            'execution_date' => 'required',
            'students' => 'array|min:1',
            'students.*.name' => 'required',
            'students.*.nim' => 'required|numeric',
        ];
    }
}
