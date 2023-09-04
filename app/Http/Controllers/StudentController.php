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
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::latest()->get();
        return view('students.index', [
            'students' => $students,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        return view('students.show', ['student' => $student]);
    }

    public function upload(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'certification' => 'required|file|mimes:pdf|max:1999',
            'studentId' => 'required|integer|min:1',
        ]);

        $file = $request->file('certification');
        $originalFileName = $file->getClientOriginalName();
        $newFileName = time() . '_' . $originalFileName;
        
        $dataToStore = [
            'name' => $newFileName,
            'student_id' => $validatedData['studentId'],
        ];

        $path = $file->storeAs('public/certifications', $newFileName);
        Certification::create($dataToStore);

        return redirect()->route('profile.edit');
    }

    public function download(Certification $certification)
    {
        $filePath = 'storage/certifications/'.$certification->name;
        $fileName = $certification->name;
        return response()->download($filePath, $fileName);
    }
}