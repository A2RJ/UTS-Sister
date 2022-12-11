<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HumanResource;
use App\Http\Requests\HumanResource\StoreHumanResourceRequest;
use App\Http\Requests\HumanResource\UpdateHumanResourceRequest;
use App\Models\Faculty;
use App\Models\Structure;
use App\Models\StudyProgram;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HumanResourceController extends Controller
{
    public function index()
    {
        return view('sister.SDM.index')->with('sdm', HumanResource::searchSDM());
    }

    public function create()
    {
        return view('sister.SDM.create')
            ->with('active_status_name', HumanResource::$active_status_name)
            ->with('employee_status', HumanResource::$employee_status)
            ->with('is_sister_exist', HumanResource::$is_sister_exist)
            ->with('sdm_type', HumanResource::$sdm_type)
            ->with('faculty', Faculty::selectOption())
            ->with('study_program', StudyProgram::selectOption())
            ->with('structures', Structure::selectOption());
    }

    public function store(StoreHumanResourceRequest $request)
    {
        $form = $request->safe()->only([
            "sdm_name",
            "nidn",
            "nip",
            "active_status_name",
            "employee_status",
            "sdm_type",
            "is_sister_exist",
            "faculty_id",
            "study_program_id",
            "structure_id",
        ]);
        $form['sdm_id'] = Hash::make($request->sdm_name);
        HumanResource::create($form);
        return $this->responseRedirect("$request->sdm_name created");
    }

    public function show(HumanResource $humanResource)
    {
        return view('sister.SDM.show')
            ->with('human_resource', $humanResource)
            ->with('active_status_name', HumanResource::$active_status_name)
            ->with('employee_status', HumanResource::$employee_status)
            ->with('is_sister_exist', HumanResource::$is_sister_exist)
            ->with('sdm_type', HumanResource::$sdm_type)
            ->with('faculty', Faculty::selectOption())
            ->with('study_program', StudyProgram::selectOption())
            ->with('structures', Structure::selectOption());
    }

    public function edit(HumanResource $humanResource)
    {
        return view('sister.SDM.edit')
            ->with('human_resource', $humanResource)
            ->with('active_status_name', HumanResource::$active_status_name)
            ->with('employee_status', HumanResource::$employee_status)
            ->with('is_sister_exist', HumanResource::$is_sister_exist)
            ->with('sdm_type', HumanResource::$sdm_type)
            ->with('faculty', Faculty::selectOption())
            ->with('study_program', StudyProgram::selectOption())
            ->with('structures', Structure::selectOption());
    }

    public function update(UpdateHumanResourceRequest $request, HumanResource $humanResource)
    {
        $form = $request->safe()->only([
            "sdm_name",
            "nidn",
            "nip",
            "active_status_name",
            "employee_status",
            "sdm_type",
            "is_sister_exist",
            "faculty_id",
            "study_program_id",
            "structure_id",
        ]);
        $humanResource->update($form);
        return $this->responseRedirect("$request->sdm_name updated");
    }

    public function destroy(HumanResource $humanResource)
    {
        $response = "$humanResource->sdm_name deleted";
        $humanResource->delete();
        return $this->responseRedirect($response);
    }

    // return structural
    public function withStructure()
    {
        $children = Structure::childrens("admin");
        $ids = collect($children)->map(function ($item) {
            return $item['id'];
        })->toArray();

        return Subject::with('study_program', 'human_resource')
            ->join('meetings', 'meetings.subject_id', 'subjects.id')
            ->whereIn('subjects.sdm_id', function ($query) use ($ids) {
                $query->select('id')
                    ->from('human_resources')
                    ->whereIn('structure_id', $ids);
            })
            ->select(
                'subjects.*',
                DB::raw('SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) AS number_of_taken'),
                DB::raw('SUM(CASE WHEN meetings.file_start IS NULL OR meetings.file_end IS NULL THEN 1 ELSE 0 END) AS number_of_not_taken'),
                DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks')
            )
            ->groupBy('subjects.id')
            ->paginate();
    }

    // return by faculty
    public function byFaculty()
    {
        $faculty_id = 1;

        $subjects = Subject::with('study_program', 'human_resource')
            ->join('meetings', 'meetings.subject_id', 'subjects.id')
            ->join('human_resources', 'human_resources.id', 'subjects.sdm_id')
            ->where('human_resources.faculty_id', $faculty_id)
            ->select(
                'subjects.*',
                DB::raw('SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) AS number_of_taken'),
                DB::raw('SUM(CASE WHEN meetings.file_start IS NULL OR meetings.file_end IS NULL THEN 1 ELSE 0 END) AS number_of_not_taken'),
                DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks')
            )
            ->groupBy('subjects.id')
            ->paginate();

        return $subjects;
    }

    // return by prodi
    public function byStudyProgram()
    {
        $study_program_id = 3;

        $subjects = Subject::with('study_program', 'human_resource')
            ->join('meetings', 'meetings.subject_id', 'subjects.id')
            ->where('subjects.study_program_id', $study_program_id)
            ->select(
                'subjects.*',
                DB::raw('SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) AS number_of_taken'),
                DB::raw('SUM(CASE WHEN meetings.file_start IS NULL OR meetings.file_end IS NULL THEN 1 ELSE 0 END) AS number_of_not_taken'),
                DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks')
            )
            ->groupBy('subjects.id')
            ->paginate();

        return $subjects;
    }

    // contoh jika kaprodi ingin ambil semua data dosen dan tendik
    public function subdivisi()
    {
        $children = Structure::childrens("admin");
        $structure_id = collect($children)->map(function ($item) {
            return $item['id'];
        })->toArray();

        $subjects = Subject::with('study_program')
            ->join('meetings', 'meetings.subject_id', 'subjects.id')
            ->join('human_resources', 'human_resources.id', 'subjects.sdm_id')
            ->whereIn('subjects.sdm_id', function ($query) use ($structure_id) {
                $query->select('id')
                    ->from('human_resources')
                    ->whereIn('structure_id', $structure_id)
                    ->where('sdm_type', 'Dosen');
            })
            ->select(
                'subjects.*',
                'human_resources.sdm_name',
                DB::raw('SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) AS number_of_taken'),
                DB::raw('SUM(CASE WHEN meetings.file_start IS NULL OR meetings.file_end IS NULL THEN 1 ELSE 0 END) AS number_of_not_taken'),
                DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks')
            )
            ->groupBy('subjects.id')
            ->get();

        return $subjects;
    }
}
