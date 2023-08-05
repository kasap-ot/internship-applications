<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StudentController extends Controller
{
    static int $studentsPerPage = 2;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::latest()->paginate(self::$studentsPerPage);
        return view('students.index', [
            'students' => $students,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }
}
