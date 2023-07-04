<?php

namespace App\Http\Requests\Wr3;

use Illuminate\Foundation\Http\FormRequest;

class DedicationsUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'funding_source' => 'required',
            'funding_amount' => 'required|numeric',
            'proposal_file' => 'nullable|file',
            'activity_schedule' => 'required|date',
            'location' => 'required',
            'participants' => 'required',
            'target_activity_outputs' => 'required',
            'public_media_publications' => 'required',
            'scientific_publications' => 'required',
            'members' => 'required',
            'assignment_letter_link' => 'required|url',
        ];
    }
}
