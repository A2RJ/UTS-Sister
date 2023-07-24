<?php

namespace App\Http\Requests\Wr3;

use Illuminate\Foundation\Http\FormRequest;

class DedicationsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role' => 'required',
            'as' => 'required',
            'theme' => 'required',
            'title' => 'required',
            'funding_source' => 'required',
            'funding_amount' => 'required|numeric',
            'proposal_file' => 'required|file',
            'activity_schedule' => 'required|date',
            'location' => 'required',
            'participants' => 'required|array|min:1',
            'participants.*.name' => 'required',
            'participants.*.nidn' => 'required|numeric',
            'participants.*.studyProgram' => 'required',
            'participants.*.detail' => 'required',
            'target_activity_outputs' => 'required',
            'public_media_publications' => 'required',
            'scientific_publications' => 'required' 
        ];
    }

    public function messages()
    {
        return [
            'role.required' => 'Jabatan harus diisi.',
            'as.required' => 'Sebagai harus diisi (misalnya narasumber dll).',
            'theme.required' => 'Tema harus diisi.',
            'title.required' => 'Judul harus diisi.',
            'funding_source.required' => 'Sumber Pendanaan harus diisi.',
            'funding_amount.required' => 'Jumlah Pendanaan harus diisi.',
            'funding_amount.numeric' => 'Jumlah Pendanaan harus berupa angka.',
            'proposal_file.required' => 'File Proposal harus diunggah.',
            'proposal_file.file' => 'File Proposal harus berupa file.',
            'activity_schedule.required' => 'Jadwal Kegiatan harus diisi.',
            'activity_schedule.date' => 'Jadwal Kegiatan harus dalam format tanggal yang valid.',
            'location.required' => 'Lokasi harus diisi.',
            'participants.*.name.required' => 'Nama harus diisi.',
            'participants.*.nidn.required' => 'NIDN harus diisi.',
            'participants.*.nidn.numeric' => 'NIDN harus angka',
            'participants.*.studyProgram.required' => 'Program study harus diisi.',
            'participants.*.detail.required' => 'detail harus diisi.',
            'target_activity_outputs.required' => 'Hasil Kegiatan harus diisi.',
            'public_media_publications.required' => 'Publikasi Media harus diisi.',
            'scientific_publications.required' => 'Publikasi Ilmiah harus diisi.', 
        ];
    }
}
