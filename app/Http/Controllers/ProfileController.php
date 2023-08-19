<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Company;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display a view-only perspective on the profile
     */
    public function show(): View
    {
        return view('profile.show');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $user = $request->user();
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($user->userable_type == Student::class) {
            $student = $user->userable;
            $student->update($validatedData);
        } elseif ($user->userable_type == Company::class) {
            $company = $user->userable;
            if ($request->hasFile('logoImage')) {
                $file = $request->file('logoImage');
                $originalFileName = $file->getClientOriginalName();
                $newFileName = time() . '_' . $originalFileName;
                $path = $file->storeAs('public/logoImages', $newFileName);
                $company->logoImage = $newFileName;
            }
            $company->update($validatedData);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $role = $user->userable_type;
        
        if ($role === Student::class)
            Student::where('id', $user->userable_id)->delete();
        elseif ($role === Company::class) {
            $company = Company::findOrFail($user->userable_id);
            $logoImage = $company->logoImage;
            $company->delete();
            if ($logoImage != 'noImage.jpg')
                Storage::delete('public/logoImages/' . $company->logoImage);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
