<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Company;
use App\Models\Student;


class AdminController extends Controller
{
    public function userRequests(): View
    {
        Gate::authorize('is-admin');
        $unverifiedUsers = User::where('verified', false)->get();
        return view('admins.user-requests', ['unverifiedUsers' => $unverifiedUsers]);
    }

    public function verifyUser(Request $request): RedirectResponse
    {
        Gate::authorize('is-admin');
        $user = User::find($request->userId);
        $user->update(['verified' => true]);
        return redirect()->route('user-requests');
    }

    public function rejectUser(Request $request): RedirectResponse
    {
        Gate::authorize('is-admin');
        $user = User::find($request->userId);
        $user->delete();
        return redirect()->route('user-requests');
    }

    public function removeUser(int $userId): RedirectResponse
    {
        Gate::authorize('is-admin');
        $user = User::find($userId);
        
        if ($user->userable_type != 'admin') {
            $user->userable->delete();
            $user->delete();
        }
        
        return redirect()->route('verified-users')
                ->with('message', 'User successfully removed');
    }

    public function verifiedUsers(): View
    {
        Gate::authorize('is-admin');
        $verifiedUsers = User::where('verified', true)->get();        
        return view('admins.verified-users', ['verifiedUsers' => $verifiedUsers]);
    }
}

?>