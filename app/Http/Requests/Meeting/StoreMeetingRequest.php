<?php

namespace App\Http\Requests\Meeting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreMeetingRequest extends FormRequest
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
            "subject_id" => ['required'],
            "subject_class_id" => ['required'],
            "start" => ['required'],
            "filename_start" => [
                'required',
                File::types(['jpg', 'jpeg', 'png'])
                    ->max(24 * 1024),
            ],
        ];
    }
}
