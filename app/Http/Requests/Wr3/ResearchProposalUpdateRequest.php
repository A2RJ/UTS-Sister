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
            'proposal_title' => 'required|max:255|unique:research_proposals,proposal_title',
            'grant_scheme' => 'required|max:255',
            'target_outcomes' => 'required|max:255',
            'proposal_file' => 'required|mimes:pdf,doc,docx|max:10240',
            'application_status' => 'required|in:Sedang dalam ajuan,Lolos pendanaan',
            'contract_period' => $this->statusAjuan() ? 'required' : 'nullable',
            'funding_amount' => $this->statusAjuan() ? 'required' : 'nullable',
            'assignment_letter_link' => $this->statusAjuan() ? 'required|url' : 'nullable',
            'publication_title' => $this->statusAjuan() ? 'required|max:255' : 'nullable|max:255',
            'author_status' => $this->statusAjuan() ? 'required|in:1,2,3,correspondence author' : 'nullable|in:1,2,3,correspondence author',
            'journal_name' => $this->statusAjuan() ? 'required|max:255' : 'nullable|max:255',
            'publication_year' => $this->statusAjuan() ? 'required|date_format:Y' : 'nullable|date_format:Y',
            'volume_number' => $this->statusAjuan() ? 'required' : 'nullable',
            'publication_date_year' => $this->statusAjuan() ? 'required|date' : 'nullable|date',
            'publisher' => $this->statusAjuan() ? 'required' : 'nullable',
            'journal_accreditation_status' => $this->statusAjuan() ? 'required|in:International,Nationally accredited,Internal' : 'nullable|in:International,Nationally accredited,Internal',
            'journal_publication_link' => $this->statusAjuan() ? 'required|url' : 'nullable|url',
            'journal_pdf_file' => $this->statusAjuan() ? 'required|mimes:pdf,doc,docx|max:10240' : 'nullable|mimes:pdf,doc,docx|max:10240'
        ]; 
    }

    public function statusAjuan()
    {
        if ($this->application_status == 'Lolos pendanaan') return true;
        return false;
    }
}
