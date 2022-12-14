<?php

namespace App\Http\Requests\StructuralPosition;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStructuralPositionRequest extends FormRequest
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
            'sdm_id' => ['required'],
            'structure_id' => ['required']
        ];
    }
}
