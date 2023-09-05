<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Certification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    static int $studentsPerPage = 2;

    public function index(): View
    {
        $students = Student::latest()->get();
        return view('students.index', [
            'students' => $students,
        ]);
    }

    public function show(Student $student): View
    {
        return view('students.show', ['student' => $student]);
    }
}