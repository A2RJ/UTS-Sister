<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\HumanResource;
use App\Models\Structure;
use App\Models\User;
use App\Traits\Utils\CustomPaginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    use CustomPaginate;

    public function index()
    {
        return view('home');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Attendance $attendance)
    {
        //
    }

    public function edit(Attendance $attendance)
    {
        //
    }


    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    public function destroy(Attendance $attendance)
    {
        //
    }

    public function subDivision()
    {
        return response([
            'lecturer' => Attendance::lecturer(),
            'attendance' => Attendance::attendance()
        ]);
    }

    public function subDivisionList()
    {
        return view('attendance.sub-division.list')
            ->with('subdivision', $this->paginate(Structure::childrens(User::child_id()), 15));
    }

    public function checkInPerMonth()
    {
        $attendances = HumanResource::with(['attendances' => function ($query) {
            $query->select(
                'sdm_id',
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_in_out)) as total_minutes')
            )->groupBy('sdm_id');
        }])->get();

        foreach ($attendances as $attendance) {
            $total_minutes = $attendance->attendances->total_minutes;
            $hours = floor($total_minutes / 60);
            $minutes = $total_minutes % 60;

            echo $attendance->sdm_name . " total jam masuk per bulan: " . $hours . " jam " . $minutes . " menit.";
        }
    }

    public function lecturerTime()
    {
        $attendances = HumanResource::with(['attendances' => function ($query) {
            $query->select(
                'sdm_id',
                DB::raw('DATE(check_in_time) as date'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) as total_minutes'),
                DB::raw('ROUND(SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) / 60, 2) as total_hours'),
            )->groupBy('sdm_id', 'date');
        }])->get();
        return $attendances;
    }

    public function lecturerTimeBetweenDates(Request $request, $start_date, $end_date)
    {
        $attendances = HumanResource::with(['attendances' => function ($query) use ($start_date, $end_date) {
            $query->select(
                'sdm_id',
                DB::raw('DATE(check_in_time) as date'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) as total_minutes'),
                DB::raw('ROUND(SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) / 60, 2) as total_hours'),
            )->whereBetween('check_in_time', [$start_date, $end_date])
                ->groupBy('sdm_id', 'date');
        }])->get();
        return $attendances;
    }

    public function lecturerTimeWhereMonthInYear($month = false, $year = false)
    {
        $attendances = HumanResource::with(['attendances' => function ($query) use ($month, $year) {
            $query->select(
                'sdm_id',
                DB::raw('DATE_FORMAT(check_in_time, "%Y-%m") as month'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) as total_minutes'),
                DB::raw('ROUND(SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) / 60, 2) as total_hours'),
            );
            if ($month) $query->whereMonth('check_in_time', $month);
            if ($year) $query->whereYear('check_in_time', $year);
            $query->groupBy('sdm_id', 'month');
        }])->get();
        return $attendances;
    }

    public function byWeek($week)
    {
        $attendances = HumanResource::with(['attendances' => function ($query) use ($week) {
            $query->select(
                'sdm_id',
                DB::raw('DATE(check_in_time) as date'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) as total_minutes'),
                DB::raw('ROUND(SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) / 60, 2) as total_hours'),
            );
            $query->whereRaw('WEEK(check_in_time, 1) = ?', [$week]);
            $query->groupBy('sdm_id', 'date');
        }])->get();
        return $attendances;
    }
}
