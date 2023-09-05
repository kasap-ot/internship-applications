<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Certification;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
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

    public function destroy(Certification $certification)
    {
        $filePath = 'storage/certifications/' . $certification->name;
        unlink($filePath);
        Certification::destroy($certification->id);
        return redirect()
            ->route('profile.edit')
            ->with('message', 'Certification deleted successfully');
    }
}
