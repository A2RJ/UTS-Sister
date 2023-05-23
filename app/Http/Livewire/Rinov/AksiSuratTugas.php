<?php

namespace App\Http\Livewire\Rinov;

use App\Models\ResearchAssignment;
use Livewire\Component;

class AksiSuratTugas extends Component
{
    public $number,
        $month,
        $year,
        $data;

    public function mount($data)
    {
        $this->data = $data;
    }

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
        ]);

        $research = ResearchAssignment::where('id', $this->data)->first();
        if ($research) {
            $research->update($this->all());

            $this->reset();
            session()->flash('success', 'Form submitted successfully.');
        }
        redirect(route('wr3.research-assignment'));
    }
}
