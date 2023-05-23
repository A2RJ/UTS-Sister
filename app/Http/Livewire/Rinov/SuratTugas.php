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
        $this->validate(
            [
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
            ],
            [
                'table.*.name.required' => 'The table name field is required.',
                'table.*.nidn.required' => 'The table NIDN field is required.',
                'table.*.nidn.numeric' => 'The table NIDN field must be numeric.',
                'table.*.studyProgram.required' => 'The table study program field is required.',
            ]
        );


        ResearchAssignment::create(array_merge([
            'sdm_id' => auth()->user()->id,
        ], $this->all()));
        $this->reset();
        session()->flash('success', 'Form submitted successfully.');
        redirect(route('wr3.research-assignment.by-user'));
    }
}
