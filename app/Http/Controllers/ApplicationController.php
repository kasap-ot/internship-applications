<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

use App\Models\Student;
use App\Models\Offer;

use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    /*
     * When the student clicks 'apply' a new application
     * for him should be created for the given offer and with
     * the status of 'waiting'
     */
    public function apply(int $offerId)
    {
        $studentId = auth()->user()->userable_id;
        $student = Student::find($studentId);
        $offer = Offer::find($offerId);
        
        Gate::authorize('can-apply', $offer);

        # If there is already an accepted / ongoing / completed 
        # student for the offer, return with an error message.
        
        $offerNotAvailable = DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->whereIn('status', ['accepted', 'ongoing', 'completed'])
            ->exists();

        if ($offerNotAvailable)
            // return 'The offer is not available'; 
            return back()->with(['message' => 'The offer is not available.']);
        else {
            $student->offers()->attach($offer, ['status' => 'waiting']);
            return redirect()->route('applications');
        }
    }

    /**
     * Get a list of all applications of the given student.
     */
    public function applications()
    {
        Gate::authorize('is-student');
        $studentId = auth()->user()->userable_id;
        $student = Student::find($studentId);
        $offers = $student->offers;
        return view('applications.index', ['offers' => $offers]);
    }

    /**
     * Get a list of all applicants for the given offer.
     */
    public function applicants(int $offerId): View
    {
        $offer = Offer::find($offerId);
        Gate::authorize('offer-owner', $offer);
        $studentsPerPage = 2;
        $applicants = $offer->students()->get();
        return view('students.index', ['students' => $applicants]);
    }

    /**
     * Update the given application to status 'accepted'.
     * Reject all other applicants for the given offer.
     */
    public function accept(int $offerId, int $studentId)
    {
        Gate::authorize('is-company');

        $status = DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->where('student_id', $studentId)
            ->value('status');

        if ($status != 'waiting') {
            return back()->with([
                'message' => "Cannot accept student with status $status",
                'studentId' => $studentId,
            ]);
        }

        // accept the given student
        DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->where('student_id', $studentId)
            ->update(['status' => 'accepted']);
        
        // reject all other students for the same offer
        DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->where('student_id', '<>', $studentId)
            ->update(['status' => 'rejected']);

        return redirect()->route('applicants', $offerId);
    }

    /**
     * Update the status of the application.
     * From 'accepted' to 'ongoing',
     * from 'ongoing' to 'completed'
     */
    public function update(int $offerId, int $studentId)
    {
        Gate::authorize('is-company');

        $application = DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->where('student_id', $studentId)
            ->first();

        if ($application->status === 'accepted')
            $newStatus = 'ongoing';
        elseif ($application->status === 'ongoing')
            $newStatus = 'completed';
        else
            $newStatus = $application->status;
        
        DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->where('student_id', $studentId)
            ->update(['status' => $newStatus]);
        
        return 'done';
    }

    /**
     * Cancel (delete) the whole application but 
     * only if the status is 'waiting' or 'accepted'.
     * If there is such an entry to delete and deletion
     * is successful, reset all other applications
     * to status 'waiting'.
     */
    public function cancel(int $offerId)
    {
        Gate::authorize('is-student');

        $studentId = auth()->user()->userable_id;

        $cancelledApplications = DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->where('student_id', $studentId)
            ->whereIn('status', ['waiting', 'accepted'])
            ->delete();
        
        # If application is deleted successfully
        # reset all other applications for offer
        
        if ($cancelledApplications == 1) {
            DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->update(['status' => 'waiting']);
            return redirect()->route('applications');
        }
        else {
            return back()
            ->with('message', 'This is not a valid request.');
        }
    }
}
