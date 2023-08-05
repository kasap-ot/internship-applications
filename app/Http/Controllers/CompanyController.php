<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companiesPerPage = 2;

        $companies = Company::latest()->paginate($companiesPerPage);
        
        return view('companies.index', [
            'companies' => $companies,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return $company;
    }
}
