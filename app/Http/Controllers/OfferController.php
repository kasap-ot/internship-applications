<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Company;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class OfferController extends Controller
{
    static $offersPerPage = 2;

    public function index(): View
    {
        $user = auth()->user();
        $user_type = $user->userable_type;

        if ($user_type == Student::class) {
            $offers = Offer::latest()->paginate(self::$offersPerPage);
        }
        elseif ($user_type == Company::class) {
            $company_id = $user->userable_id;
            $offers = Offer::where('company_id', $company_id)
                ->latest()
                ->paginate(self::$offersPerPage);
        }

        return view('offers.index', ['offers' => $offers,]);
    }

    /**
     * Display all offers, but filtered by different fields.
     */
    public function filter(Request $request): View
    {
        Gate::authorize('is-student');

        $query = Offer::query();

        if ($request->has('field'))
            $query->where('field', $request->input('field'));

        if ($request->has('minSalary'))
            $query->where('salary', '>=', $request->input('minSalary'));

        if ($request->has('maxSalary'))
            $query->where('salary', '<=', $request->input('maxSalary'));

        $offers = $query->paginate(self::$offersPerPage);

        return view('offers.index', ['offers' => $offers,]);
    }

    public function create(): View
    {
        Gate::authorize('is-company');
        return view('offers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('is-company');

        $validatedData = $request->validate([
            'field' => 'required|string|max:100',
            'salary' => 'required|integer',
            'dateFrom' => 'required|date',
            'dateTo' => 'required|after:dateFrom',
            'description' => 'required|string|max:255',
            'requirements' => 'required|string|max:255',
        ]);

        $user_id = auth()->user()->userable_id;
        $validatedData['company_id'] = $user_id;

        Offer::create($validatedData);

        return redirect()->route('offers.index')
            ->with('success', 'Offer created successfully!');
    }

    public function show(Offer $offer): View
    {
        return view('offers.show', ['offer' => $offer]);
    }

    public function edit(Offer $offer): View
    {
        Gate::authorize('offer-owner', $offer);

        return view('offers.edit', [
            'offer' => $offer,
        ]);
    }

    public function update(Request $request, Offer $offer): RedirectResponse
    {
        Gate::authorize('offer-owner', $offer);

        $validated = $request->validate([
            'field' => 'string|max:100',
            'salary' => 'integer',
            'dateFrom' => 'date',
            'dateTo' => 'date|after:dateFrom',
            'description' => 'string|max:255',
            'requirements' => 'string|max:255',
        ]);

        $offer->update($validated);

        return redirect(route('offers.index'));
    }

    public function destroy(Offer $offer)
    {
        Gate::authorize('offer-owner', $offer);

        $offer->delete();

        return redirect(route('offers.index'))->with('success', 'Offer deleted successfully');
    }
}
