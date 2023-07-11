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
        $rules = [
            'jenis_izin' => 'required|between:1,6|numeric',
            'detail' => 'required',
            'attachment' => 'required|mimes:doc,docx,pdf,jpeg,jpg,png|max:4096',
        ];

        if (in_array(request()->input('jenis_izin'), [1, 2, 3, 4])) {
            $rules['start_date'] = ['required', 'date_format:Y-m-d'];
            $rules['end_date'] = ['nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'];
        }

        return $rules;
    }
}
