<?php

namespace App\Http\Requests\Meeting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateMeetingRequest extends FormRequest
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
            // "subject_id" => ['required'],
            // "meeting_name" => ['required'],
            // "datetime_local" => ['required'],
            // "meeting_start" => ['require'],
            // "file_start" => [
            //     'require',
            //     File::types(['jpg', 'jpeg', 'png'])
            //     ->max(24 * 1024),
            // ],
            // "meeting_end" => ['required'],
            "file_end" => [
                'required',
                File::types(['jpg', 'jpeg', 'png'])
                    ->max(24 * 1024),
            ],
        ];
    }
}
