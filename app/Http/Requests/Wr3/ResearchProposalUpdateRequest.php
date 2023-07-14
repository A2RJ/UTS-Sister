<?php

namespace App\Http\Requests\Wr3;

use Illuminate\Foundation\Http\FormRequest;

class ResearchProposalUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'proposal_title' => 'required|max:255',
            'grant_scheme' => 'required|max:255',
            'target_outcomes' => 'required|max:255',
            'proposal_file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'application_status' => 'required|in:Sedang dalam ajuan,Lolos pendanaan',
            'contract_period' => 'required',
            'funding_amount' => 'required',
            'publication_title' => $this->statusAjuan() ? 'required|max:255' : 'nullable',
            'author_status' => $this->statusAjuan() ? 'required|in:1,2,3,correspondence author' : 'nullable',
            'journal_name' => $this->statusAjuan() ? 'required|max:255' : 'nullable',
            'publication_year' => $this->statusAjuan() ? 'required|date_format:Y' : 'nullable',
            'volume_number' => $this->statusAjuan() ? 'required' : 'nullable',
            'publication_date_year' => $this->statusAjuan() ? 'required|date' : 'nullable',
            'publisher' => $this->statusAjuan() ? 'required' : 'nullable',
            'journal_accreditation_status' => $this->statusAjuan() ? 'required|in:International,Nationally accredited,Internal' : 'nullable',
            'journal_publication_link' => $this->statusAjuan() ? 'required|url' : 'nullable',
            'journal_pdf_file' => $this->statusAjuan() ? 'nullable|mimes:pdf,doc,docx|max:10240' : 'nullable'
        ];
    }

    public function statusAjuan(): bool
    {
        if ($this->application_status == 'Lolos pendanaan') return true;
        return false;
    }

    public function messages(): array
    {
        return [
            'proposal_title.required' => 'Judul Proposal wajib diisi.',
            'proposal_title.max' => 'Judul Proposal tidak boleh lebih dari :max karakter.',
            'proposal_title.unique' => 'Judul Proposal sudah ada dalam database.',
            'grant_scheme.required' => 'Skema Hibah wajib diisi.',
            'grant_scheme.max' => 'Skema Hibah tidak boleh lebih dari :max karakter.',
            'target_outcomes.required' => 'Target Luaran wajib diisi.',
            'target_outcomes.max' => 'Target Luaran tidak boleh lebih dari :max karakter.',
            'proposal_file.required' => 'Proposal wajib diisi.',
            'proposal_file.mimes' => 'Format file yang diperbolehkan untuk Proposal adalah PDF atau dokumen Word.',
            'proposal_file.max' => 'Ukuran file Proposal tidak boleh lebih dari :max kilobita.',
            'application_status.required' => 'Status Ajuan wajib diisi.',
            'application_status.in' => 'Status Ajuan harus salah satu dari: Sedang dalam ajuan, Lolos pendanaan.',
            'contract_period.required' => 'Periode Kontrak wajib diisi.',
            'funding_amount.required' => 'Jumlah Pendanaan wajib diisi.', 'publication_title.required' => 'Judul Publikasi wajib diisi.',
            'publication_title.max' => 'Judul Publikasi tidak boleh lebih dari :max karakter.',
            'author_status.required' => 'Status Penulis wajib diisi.',
            'author_status.in' => 'Status Penulis harus salah satu dari: 1, 2, 3, correspondence author.',
            'journal_name.required' => 'Nama Jurnal wajib diisi.',
            'journal_name.max' => 'Nama Jurnal tidak boleh lebih dari :max karakter.',
            'journal_pdf_file.required' => 'File Jurnal wajib diisi.',
            'journal_pdf_file.mimes' => 'Format file yang diperbolehkan untuk File Jurnal adalah PDF atau dokumen Word.',
            'journal_pdf_file.max' => 'Ukuran file File Jurnal tidak boleh lebih dari :max kilobita.',
            'publication_year.required' => 'Tahun wajib diisi.',
            'publication_year.date_format' => 'Tahun harus dalam format YYYY.',
            'volume_number.required' => 'Vol/No. wajib diisi.',
            'publication_date_year.required' => 'Tanggal dan Tahun Terbit wajib diisi.',
            'publication_date_year.date' => 'Tanggal dan Tahun Terbit harus dalam format tanggal yang valid.',
            'publisher.required' => 'Penerbit wajib diisi.',
            'journal_accreditation_status.required' => 'Status Akreditasi Jurnal wajib diisi.',
            'journal_accreditation_status.in' => 'Status Akreditasi Jurnal harus salah satu dari: International, Nationally accredited, Internal.',
            'journal_publication_link.required' => 'Link Publikasi Jurnal wajib diisi.',
            'journal_publication_link.url' => 'Link Publikasi Jurnal harus berupa URL yang valid.',
        ];
    }
}
