<?php

namespace App\Http\Requests\Presence;

use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorePresenceRequestAPI extends FormRequest
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
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'detail' => 'required_if:isLateCheck,true',
            'attachment' => 'nullable:file',
        ];
    }

    private function isLateCheck()
    {
        if (!request()->user()->sdm_type) return response()->json(['message' => 'Set SDM type'], 500);
        $data = Presence::$workHour[request()->user()->sdm_type];
        return Carbon::now() < $data['in'] ? true : false;
    }
}
