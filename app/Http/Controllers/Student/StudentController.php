<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class StudentController extends Controller
{

    public function index()
    {
        $students = (new FastExcel())->import('students.xlsx');
        return $students->map(function ($student) {
            return [
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => $student['password'],
                'nim' => $student['nik'],
                'alamat' => $student['alamat'],
                'no_hp' => $student['no_hp'],
                'kelamin' => $student['kelamin'],
                'agama' => $student['agama'],
                'prodi' => $student['prodi'],
                'fakultas' => $student['fakultas'],
                'active' => $student['is_active'],
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
