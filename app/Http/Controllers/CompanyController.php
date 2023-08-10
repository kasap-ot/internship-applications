<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    static int $companiesPerPage = 2;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Gate::authorize('is-student');
        $companies = Company::latest()->get();
        return view('companies.index', ['companies' => $companies,]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $companyId)
    {
        Gate::authorize('is-student');
        $company = Company::find($companyId);
        return view('companies.show', ['company' => $company]);
    }
}
