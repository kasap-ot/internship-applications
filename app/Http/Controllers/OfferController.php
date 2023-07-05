<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offersPerPage = 2;

        $offers = Offer::latest()->paginate($offersPerPage);

        return view('offers.index', [
            'offers' => $offers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'field' => 'required|string|max:100',
            'salary' => 'required|integer',
            'dateFrom' => 'required|date',
            'dateTo' => 'required|after:dateFrom',
            'description' => 'required|string|max:255',
            'requirements' => 'required|string|max:255',
        ]);

        Offer::create($validatedData);

        return redirect()->route('offers.index')
            ->with('success', 'Offer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer): View
    {
        return view('offers.edit', [
            'offer' => $offer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer): RedirectResponse
    {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
