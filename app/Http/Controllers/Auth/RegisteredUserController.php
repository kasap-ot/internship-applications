<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\Response;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function registerAs(): View {
        return view('auth.register-as');
    }

    public function registerStudent(): View {
        return view('auth.register-student');
    }

    public function registerCompany(): View {
        return view('auth.register-company');
    }

    public function registerAdmin(): View {
        return view('auth.register-admin');
    }

    private function validateUserFields(Request $request): void {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    }

    private function storeUser(Request $request, $userable_id, $className): User {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userable_id' => $userable_id,
            'userable_type' => $className,
        ]);
    }

    public function storeStudent(Request $request): RedirectResponse
    {
        $this->validateUserFields($request);

        // Validate the student-specific fields
        $validatedData = $request->validate([
            'gpa' => 'required|decimal:2',
            'university' => 'required|string|max:100',
            'major' => 'required|string|max:100',
            'dateEnrolled' => 'required|date',
            'credits' => 'required|integer',
        ]);

        // The student should be in the DB first
        $student = Student::create($validatedData);
        $user = $this->storeUser($request, $student->id, Student::class);

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function storeCompany(Request $request): RedirectResponse
    {
        $this->validateUserFields($request);

        // Validate the company-specific fields
        $validatedData = $request->validate([
            'numEmployees' => 'required|integer',
            'field' => 'required|string|max:100',
            'foundingYear' => 'required|integer|min:1',
            'description' => 'required|string|max:255',
            'website' => 'required|string|max:100',
            'address' => 'required|string|max:100',
        ]);

        // Store the company information in the DB first
        $company = Company::create($validatedData);
        $user = $this->storeUser($request, $company->id, Company::class);

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function storeAdmin(Request $request): RedirectResponse
    {
        $this->validateUserFields($request);
        
        $dummyUserReferenceId = 0;
        $user = $this->storeUser($request, $dummyUserReferenceId, 'admin');
        event(new Registered($user));
        Auth::login($user);
        
        // Because this is an admin-user, he is verified by default
        User::where('id', $user->id)->update(['verified' => true]);
        
        return redirect(RouteServiceProvider::HOME);
    }
}
