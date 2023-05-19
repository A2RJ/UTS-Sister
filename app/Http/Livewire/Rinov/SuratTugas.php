<?php

namespace App\Http\Livewire\Rinov;

use App\Models\ResearchAssignment;
use Livewire\Component;

class SuratTugas extends Component
{
    public $role,
        $activity,
        $as,
        $theme,
        $date,
        $organizer,
        $location,
        $table = [
            [
                'name' => '',
                'nidn' => '',
                'studyProgram' => ''
            ]
        ];

    public function addTable()
    {
        $this->table[] = [
            'name' => '',
            'nidn' => '',
            'studyProgram' => ''
        ];
    }

    public function removeTable($index)
    {
        unset($this->table[$index]);
        $this->table = array_values($this->table);
    }

    public function render()
    {
        return view('livewire.rinov.surat-tugas');
    }

    public function submit()
    {
        $this->validate([
            'role' => 'required',
            'activity' => 'required',
            'as' => 'required',
            'theme' => 'required',
            'date' => 'required',
            'organizer' => 'required',
            'location' => 'required',
            'table.*.name' => 'required',
            'table.*.nidn' => 'required|numeric',
            'table.*.studyProgram' => 'required',
        ]);


        ResearchAssignment::create(array_merge([
            'sdm_id' => auth()->user()->id,
        ], $this->all()));
        $this->reset();
        session()->flash('success', 'Form submitted successfully.');
        redirect('/');
    }
}
