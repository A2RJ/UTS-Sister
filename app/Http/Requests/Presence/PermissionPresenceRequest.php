<?php

namespace App\Http\Requests\Presence;

use Illuminate\Foundation\Http\FormRequest;

class PermissionPresenceRequest extends FormRequest
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
            'sdm_id' => 'required',
            'sdm_type' => 'required',
            'attachment' => 'file'
        ];
    }
}
