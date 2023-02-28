<?php

namespace App\Http\Requests\HumanResource;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateHumanResourceRequest extends FormRequest
{
    public $id;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->id = $request->human_resource->id;
    }
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
            "sdm_name" => ['required'],
            "email" => ['required', Rule::unique('human_resources')->ignore($this->id)],
            "nidn" => ['nullable', 'numeric'],
            "nip" => ['nullable', 'numeric'],
            "active_status_name" => ['required'],
            "employee_status" => ['required'],
            "sdm_type" => ['required'],
            "is_sister_exist" => ['boolean'],
            "faculty_id" => ['nullable', 'numeric'],
        ];
    }
}
