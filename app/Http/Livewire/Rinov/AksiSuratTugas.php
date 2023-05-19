<?php

namespace App\Http\Livewire\Rinov;

use App\Models\ResearchAssignment;
use Livewire\Component;

class AksiSuratTugas extends Component
{
    public $number,
        $month,
        $year,
        $status;

    public function render()
    {
        return view('livewire.rinov.aksi-surat-tugas');
    }

    public function submit()
    {
        $this->validate([
            'number' => 'required',
            'month' => 'required',
            'year' => 'required',
            'status' => 'required|in:0,1'
        ]);

        ResearchAssignment::create($this->all());
        $this->reset();
        session()->flash('success', 'Form submitted successfully.');
        redirect('/');
    }
}
