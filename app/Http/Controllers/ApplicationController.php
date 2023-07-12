<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
    public function apply(Request $request)
    {
        $studentId = $request->input('studentId');
        $offerId = $request->input('offerId');

        $student = Student::find($studentId);
        $offer = Offer::find($offerId);

        $student->offers()->attach($offer, ['status' => 'waiting']);

        return 'done';
    }

    /**
     * Get a list of all applications of the given student.
     */
    public function applications(int $studentId)
    {
        $student = Student::find($studentId);
        $offers = $student->offers;
        return $offers;
    }

    /**
     * Get a list of all applicants for the given offer.
     */
    public function applicants(int $offerId)
    {
        $offer = Offer::find($offerId);
        $applicants = $offer->students;
        return $applicants;
    }

    /**
     * Update the given application to status 'accepted'.
     * Reject all other applicants for the given offer.
     */
    public function accept(Request $request)
    {
        $offerId = $request->input('offerId');
        $studentId = $request->input('studentId');

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

        return 'done';
    }

    /**
     * Update the status of the application.
     * From 'accepted' to 'ongoing',
     * from 'ongoing' to 'completed'
     */
    public function update(Request $request)
    {
        $offerId = $request->input('offerId');
        $studentId = $request->input('studentId');

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
     */
    public function cancel(Request $request)
    {
        $offerId = $request->input('offerId');
        $studentId = $request->input('studentId');

        DB::table('offer_student')
            ->where('offer_id', $offerId)
            ->where('student_id', $studentId)
            ->whereIn('status', ['waiting', 'accepted'])
            ->delete();

        return 'done';
    }
}
