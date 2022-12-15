<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResource\StoreHumanResourceRequest;
use App\Http\Requests\HumanResource\UpdateHumanResourceRequest;
use App\Models\HumanResource;
use App\Models\Structure;
use App\Models\Subject;

class HumanResourceController extends Controller
{
    public function index()
    {
        return view('admin.human_resource.index')->with('sdm', HumanResource::searchSDM());
    }

    public function create()
    {
        return view('admin.human_resource.create')
            ->with('active_status_name', HumanResource::$active_status_name)
            ->with('employee_status', HumanResource::$employee_status)
            ->with('is_sister_exist', HumanResource::$is_sister_exist)
            ->with('sdm_type', HumanResource::$sdm_type)
            ->with('structures', Structure::selectOptionStructure());
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
            "structure_id",
            "structure_id",
        ]);
        $form['sdm_id'] = Hash::make($request->sdm_name);
        $sdmEmail = preg_replace("/\s+/", ".", $request['sdm_name']);
        $form['email'] = Str::lower($sdmEmail) . '@uts.ac.id';
        $form['password'] = Hash::make($request['nidn']);
        HumanResource::create($form);
        return redirect(route('human_resource.index'))->with('message', "$request->sdm_name created");
    }

    public function show(HumanResource $humanResource)
    {
        return view('admin.human_resource.show')
            ->with('human_resource', $humanResource)
            ->with('active_status_name', HumanResource::$active_status_name)
            ->with('employee_status', HumanResource::$employee_status)
            ->with('is_sister_exist', HumanResource::$is_sister_exist)
            ->with('sdm_type', HumanResource::$sdm_type)
            ->with('structures', Structure::selectOption());
    }

    public function edit(HumanResource $humanResource)
    {
        return view('admin.human_resource.edit')
            ->with('human_resource', $humanResource)
            ->with('active_status_name', HumanResource::$active_status_name)
            ->with('employee_status', HumanResource::$employee_status)
            ->with('is_sister_exist', HumanResource::$is_sister_exist)
            ->with('sdm_type', HumanResource::$sdm_type)
            ->with('structures', Structure::selectOptionStructure());
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
            "structure_id"
        ]);
        $humanResource->update($form);
        return redirect(route('human_resource.index'))->with('message', "$request->sdm_name updated");
    }

    public function destroy(HumanResource $humanResource)
    {
        $response = "$humanResource->sdm_name deleted";
        $humanResource->delete();
        return $this->responseRedirect($response);
    }

    public function subdivisi($child_id)
    {
        $children = Structure::childrens($child_id);
        $ids = collect($children)->map(function ($item) {
            return $item['id'];
        })->toArray();

        $results = Subject::select(
            'subjects.id',
            'subject',
            'sks',
            'number_of_meetings',
            'structure_id',
            'sdm_id',
            DB::raw('ROUND((SUM(CASE WHEN meetings.file_start IS NOT NULL AND meetings.file_end IS NOT NULL THEN 1 ELSE 0 END) / SUM(number_of_meetings)) * SUM(sks), 2) AS value_sks'),
            DB::raw('COUNT(meetings.file_start) AS meetings_completed'),
            DB::raw('COUNT(*) - COUNT(meetings.file_start) AS meetings_pending'),
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, meetings.meeting_start, meetings.meeting_end)) AS meeting_duration')
        )
            ->join('meetings', 'subjects.id', 'meetings.subject_id')
            ->with(['study_program:id,role', 'human_resource:id,sdm_name'])
            ->whereIn('subjects.sdm_id', function ($query) use ($ids) {
                $query->select('id')
                    ->from('human_resources');
                // ->whereIn('structure_id', $ids);
            })
            ->groupBy(
                'subjects.id',
                'subject',
                'sks',
                'number_of_meetings',
                'structure_id',
                'sdm_id'
            )
            ->paginate();

        return response($results);
    }
}
