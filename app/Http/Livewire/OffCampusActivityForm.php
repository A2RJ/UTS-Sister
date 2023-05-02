<?php

namespace App\Http\Livewire;

use App\Models\Wr3\OffCampusActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class OffCampusActivityForm extends Component
{
    use WithFileUploads;

    public $title,
        $location,
        $performance_certificate,
        $budget_source,
        $funding_amount,
        $execution_date,
        $students = [],
        $list_budget_source = [
            'Mandiri',
            'Universitas',
            'Instansi Tempat Kerjasama',
            'Kerjasama',
        ],
        $isFormHide = true;

    public function render()
    {
        return view('livewire.off-campus-activity-form')
            ->with('offCampusActivities', OffCampusActivity::where('sdm_id', Auth::id())->paginate());
    }

    public function formToggle()
    {
        $this->isFormHide = !$this->isFormHide;
    }

    public function addStudent()
    {
        $this->students[] = [
            'name' => '',
            'nim' => '',
        ];
    }

    public function deleteStudent($index)
    {
        unset($this->students[$index]);
        $this->students = array_values($this->students);
    }

    public function submit(Request $request)
    {
        $validated = $this->validate([
            'title' => 'required|unique:off_campus_activities,title',
            'location' => 'required',
            'performance_certificate' => 'required|mimes:pdf,doc,docx|max:10240',
            'budget_source' => 'required',
            'funding_amount' => 'required',
            'execution_date' => 'required',
            'students' => 'array|min:1',
            'students.*.name' => 'required',
            'students.*.nim' => 'required|numeric',
        ]);

        $validated['number_of_students'] = count($this->students);
        $students = collect($validated['students'])->map(function ($student) {
            return [
                'name' => $student['name'],
                'nim' => $student['nim'],
            ];
        })->toJson();
        $validated['students'] = $students;
        $validated['performance_certificate'] = $this->performance_certificate->store('riset');

        $request->user()->offCampusActivity()->create($validated);
        $this->isFormHide = true;
        session()->flash('success', 'Data aktivitas di luar kampus berhasil disimpan!');
    }
}
