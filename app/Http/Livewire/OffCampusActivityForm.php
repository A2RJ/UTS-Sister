<?php

namespace App\Http\Livewire;

use App\Http\Requests\Wr3\OffCampusRequest;
use App\Http\Requests\Wr3\OffCampusUpdateRequest;
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
        $isFormHide = true,
        $updateId = null;

    public function render()
    {
        return view('livewire.off-campus-activity-form')
            ->with('offCampusActivities', OffCampusActivity::where('sdm_id', Auth::id())->paginate());
    }

    public function formToggle($updateId = null)
    {
        $this->updateId = $updateId;

        if ($updateId) {
            $activity = OffCampusActivity::findOrFail($updateId);

            $this->title = $activity->title;
            $this->location = $activity->location;
            $this->budget_source = $activity->budget_source;
            $this->funding_amount = $activity->funding_amount;
            $this->execution_date = $activity->execution_date;
            $this->students = json_decode($activity->students, true);
        }

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
        $validated = $this->validate((new OffCampusRequest())->rules());

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
        $this->reset();
        session()->flash('success', 'Data aktivitas di luar kampus berhasil disimpan!');
    }

    public function update()
    {
        $validated = $this->validate((new OffCampusUpdateRequest())->rules());
        $validated['number_of_students'] = count($this->students);
        $students = collect($validated['students'])->map(function ($student) {
            return [
                'name' => $student['name'],
                'nim' => $student['nim'],
            ];
        })->toJson();
        $validated['students'] = $students;

        if ($this->performance_certificate && $this->performance_certificate->hasFile()) {
            $validated['performance_certificate'] = $this->performance_certificate->store('riset');
        } else {
            unset($validated['performance_certificate']);
        }

        $activity = OffCampusActivity::findOrFail($this->updateId);
        $activity->update($validated);

        $this->isFormHide = true;
        $this->reset();
        session()->flash('success', 'Data aktivitas di luar kampus berhasil diupdate!');
    }
}
