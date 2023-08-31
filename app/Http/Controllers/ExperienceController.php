<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * ADD AUTHORIZATION FOR THE THIS CONTROLLER!
     */

    public function create()
    {
        return view('experiences.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'position' => 'required|string|max:100',
            'fromDate' => 'required|date',
            'toDate' => 'required|date|after:fromDate',
            'description' => 'required|string',
        ]);
        
        $studentId = auth()->user()->userable_id;
        $validatedData['student_id'] = $studentId;

        Experience::create($validatedData);

        return redirect()
            ->route('profile.edit')
            ->with('message', 'Experience item created successfully');
    }

    public function edit()
    {

    }

    public function update(Request $request, Experience $experience)
    {

    }

    public function destroy(Experience $experience)
    {

    }
}
