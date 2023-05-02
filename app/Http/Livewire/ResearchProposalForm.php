<?php

namespace App\Http\Livewire;

use App\Http\Requests\Wr3\ResearchProposalRequest;
use App\Models\Wr3\ResearchProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $journal_accreditation_statuses = ['International', 'Nationally accredited', 'Internal'],
        $isFormHide = true;

    public function render()
    {
        return view('livewire.research-proposal-form')
            ->with('researches', ResearchProposal::where('sdm_id', Auth::id())->paginate());
    }

    public function formToggle()
    {
        $this->isFormHide = !$this->isFormHide;
    }

    public function submit()
    {
        $validated = $this->validate((new ResearchProposalRequest())->rules());
        $validated['proposal_file'] = $this->proposal_file->store('riset');
        $validated['journal_pdf_file'] = $this->journal_pdf_file->store('riset');

        request()->user()->researchProposal()->create($validated);
        $this->isFormHide = true;
        session()->flash('success', 'Data research proposal berhasil disimpan!');
    }
}
