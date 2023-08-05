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
        $companies = Company::latest()->paginate(self::$companiesPerPage);
        return view('companies.index', ['companies' => $companies,]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        Gate::authorize('is-student');
        return $company;
    }
}
