<?php

namespace App\Http\Requests\Wr3;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class LetterNumeringRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'number' => 'nullable|numeric',
            'month' => 'nullable|numeric|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'year' => 'nullable|numeric',
            'accepted_date' => 'required'
        ];
    }
}
