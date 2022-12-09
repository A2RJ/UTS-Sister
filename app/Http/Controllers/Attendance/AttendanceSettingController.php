<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceSettingController extends Controller
{
    public function index()
    {
        return view('attendance.setting.index');
    }

    public function create()
    {
        return view();
    }
}
