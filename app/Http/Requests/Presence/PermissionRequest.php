<?php

namespace App\Http\Requests\Presence;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        // return [
        //     'jenis_izin' => 'required',
        //     'detail' => 'required',
        //     'attachment' => 'required|mimes:doc,docx,pdf,jpeg,jpg,png|max:4096',
        // ];
        $rules = [
            'jenis_izin' => 'required',
            'detail' => 'required',
            'attachment' => 'required|mimes:doc,docx,pdf,jpeg,jpg,png|max:4096',
        ];

        if ($this->input('jenis_izin') == 6) {
            $rules['detail'] = 'nullable';
            $rules['attachment'] = 'nullable|mimes:doc,docx,pdf,jpeg,jpg,png|max:4096';
        }

        return $rules;
    }
}
