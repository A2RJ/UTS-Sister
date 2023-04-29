<?php

namespace App\Http\Livewire;

use App\Http\Requests\Wr3\ResearchProposalRequest;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class ResearchProposalForm extends Component
{
    use WithFileUploads;

    public $proposal_title,
        $grant_scheme,
        $target_outcomes,
        $proposal_file,
        $application_status,
        $contract_period,
        $funding_amount,
        $verification = 0,
        $assignment_letter_link,
        $publication_title,
        $author_status,
        $journal_name,
        $publication_year,
        $volume_number,
        $publication_date_year,
        $publisher,
        $journal_accreditation_status,
        $journal_publication_link,
        $journal_pdf_file,
        $statuses = ['Sedang dalam ajuan', 'Lolos pendanaan'],
        $author_statuses = [1, 2, 3, 'correspondence author'],
        $journal_accreditation_statuses = ['International', 'Nationally accredited, Internal'];

    public function render()
    {
        return view('livewire.research-proposal-form');
    }

    public function submit()
    {
        $validated = $this->validate((new ResearchProposalRequest())->rules());
        $validated['proposal_file'] = $this->proposal_file->store('proposal', 'public');
        $validated['journal_pdf_file'] = $this->journal_pdf_file->store('proposal', 'public');

        request()->user()->researchProposal()->create($validated);
        session()->flash('success', 'Data research proposal berhasil disimpan!');
    }
}
