<?php

namespace App\Http\Requests\Wr3;

use Illuminate\Foundation\Http\FormRequest;

class ResearchAssignment extends FormRequest
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
            'role' => 'required',
            'activity' => 'required',
            'as' => 'required',
            'theme' => 'required',
            'dateStart' => 'required',
            'dateEnd' => 'nullable',
            'organizer' => 'required',
            'location' => 'required',
            'table' => 'required|array|min:1',
            'table.*.name' => 'required',
            'table.*.nidn' => 'required|numeric',
            'table.*.studyProgram' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'Jabatan harus diisi.',
            'activity.required' => 'Kegiatan harus diisi.',
            'as.required' => 'Sebagai harus diisi.',
            'theme.required' => 'Tema harus diisi.',
            'dateStart.required' => 'Tanggal Mulai harus diisi.',
            'organizer.required' => 'Penyelenggara harus diisi.',
            'location.required' => 'Lokasi harus diisi.',
            'table.*.name.required' => 'Nama harus diisi.',
            'table.*.nidn.required' => 'NIDN harus diisi.',
            'table.*.nidn.numeric' => 'NIDN harus angka',
            'table.*.studyProgram.required' => 'Program study harus diisi.',
        ];
    }
}
