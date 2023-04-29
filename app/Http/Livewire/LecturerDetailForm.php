<?php

namespace App\Http\Livewire;

use App\Http\Requests\Wr3\LecturerDetailRequest;
use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Livewire\Component;

class LecturerDetailForm extends Component
{
    public $faculty,
        $study_program,
        $expertise,
        $theme,
        $other_theme,
        $showOtherTheme,
        $themes = [
            'Green economy',
            'Blue economy',
            'Social science',
            'Humaniora',
            'Engineering',
            'Lain-lain'
        ];


    public function mount()
    {
        $user = request()->user();
        $detail = $user->detail;

        $this->faculty = $detail ? $detail->faculty_id : '';
        $this->study_program = $detail ? $detail->study_program_id : '';
        $this->expertise = $detail ? $detail->expertise : '';
        $this->theme = $detail ? $detail->theme : '';
        $this->showOtherTheme = $detail ? $detail->theme == 'Lain-lain' : false;
        $this->other_theme = $detail ? ($detail->theme == 'Lain-lain' ? $detail->other_theme : '') : '';
    }

    public function render()
    {
        return view('livewire.lecturer-detail-form')
            ->with('user', request()->user())
            ->with('faculties', Faculty::all())
            ->with('study_programs', $this->faculty ? StudyProgram::where('faculty_id', $this->faculty)->get() : []);
    }

    public function themeSelected()
    {
        if ($this->theme == 'Lain-lain') {
            $this->showOtherTheme = true;
        } else {
            $this->showOtherTheme = false;
        }
    }

    public function submit()
    {
        $validated = $this->validated((new LecturerDetailRequest())->rules());
        request()->user()->detail()->updateOrCreate(
            ['sdm_id' => request()->user()->id],
            [
                'faculty_id' => $validated['faculty'],
                'study_program_id' => $validated['study_program'],
                'expertise' => $validated['expertise'],
                'theme' => $validated['theme'],
                'other_theme' => $this->showOtherTheme ? $validated['other_theme'] : '-',
            ]
        );
        session()->flash('success', 'Data dosen berhasil disimpan!');
    }
}
