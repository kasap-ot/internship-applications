<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Role;
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
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

/*
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
*/

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

        $request->validate([
            'gpa' => 'required|decimal:2',
            'university' => 'required|string|max:100',
            'major' => 'required|string|max:100',
            'dateEnrolled' => 'required|date',
            'credits' => 'required|integer',
            'userable_type' => 'required',
        ]);

        $userType = $request->input('userable_type');

        if ($userType != 'student')
            abort(400, 'Invalid type provived: ' . $userType);

        $student = Student::create([
            'gpa' => $request->input('gpa'),
            'university' => $request->input('university'),
            'major' => $request->input('major'),
            'dateEnrolled' => $request->input('dateEnrolled'),
            'credits' => $request->input('credits'),
        ]);

        $user = $this->storeUser($request, $student->id, Student::class);

        event(new Registered($user));
        Auth::login($user);

        dd($user->userable);
        
        return redirect(RouteServiceProvider::HOME);
    }

    public function storeCompany(Request $request): RedirectResponse
    {
        // potentially call a private function for storing the user
        // info that is common to all user types
        // validate the data
        // store the data
        // run code for user registration and login
        // finally return the redirect
    }

    public function storeAdmin(Request $request): RedirectResponse
    {
        // potentially call a private function for storing the user
        // info that is common to all user types
        // validate the data
        // store the data
        // run code for user registration and login
        // finally return the redirect

        return response()->json(
            ['message' => 'Not Implemented'], 
            Response::HTTP_NOT_IMPLEMENTED
        );
    }
}
