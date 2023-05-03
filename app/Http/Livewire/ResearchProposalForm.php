<?php

namespace App\Http\Livewire;

use App\Http\Requests\Wr3\ResearchProposalRequest;
use App\Http\Requests\Wr3\ResearchProposalUpdateRequest;
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
        $isFormHide = true,
        $updateId = null;

    public function render()
    {
        return view('livewire.research-proposal-form')
            ->with('researches', ResearchProposal::where('sdm_id', Auth::id())->paginate());
    }

    public function formToggle($updateId = null)
    {
        $this->updateId = $updateId;

        if ($updateId) {
            $research = ResearchProposal::findOrFail($updateId);

            $this->proposal_title = $research->proposal_title;
            $this->grant_scheme = $research->grant_scheme;
            $this->target_outcomes = $research->target_outcomes;
            $this->application_status = $research->application_status;
            $this->contract_period = $research->contract_period;
            $this->funding_amount = $research->funding_amount;
            $this->verification = $research->verification;
            $this->assignment_letter_link = $research->assignment_letter_link;
            $this->publication_title = $research->publication_title;
            $this->author_status = $research->author_status;
            $this->journal_name = $research->journal_name;
            $this->publication_year = $research->publication_year;
            $this->volume_number = $research->volume_number;
            $this->publication_date_year = $research->publication_date_year;
            $this->publisher = $research->publisher;
            $this->journal_accreditation_status = $research->journal_accreditation_status;
            $this->journal_publication_link = $research->journal_publication_link;
        }
        $this->isFormHide = !$this->isFormHide;
    }

    public function submit()
    {
        $validated = $this->validate((new ResearchProposalRequest())->rules());
        $validated['proposal_file'] = $this->proposal_file->store('riset');
        $validated['journal_pdf_file'] = $this->journal_pdf_file->store('riset');

        request()->user()->researchProposal()->create($validated);
        $this->isFormHide = true;
        $this->reset();
        session()->flash('success', 'Data research proposal berhasil disimpan!');
    }

    public function update()
    {
        $validated = $this->validate((new ResearchProposalUpdateRequest())->rules());
        if ($this->proposal_file && $this->proposal_file->hasFile()) {
            $validated['proposal_file'] = $this->proposal_file->store('riset');
        } else {
            unset($validated['proposal_file']);
        }
        if ($this->journal_pdf_file && $this->journal_pdf_file->hasFile()) {
            $validated['journal_pdf_file'] = $this->journal_pdf_file->store('riset');
        } else {
            unset($validated['journal_pdf_file']);
        }
        $proposal = ResearchProposal::findOrFail($this->updateId);
        $proposal->update($validated);

        $this->isFormHide = true;
        $this->reset();
        session()->flash('success', 'Data research proposal berhasil diupdate!');
    }
}
