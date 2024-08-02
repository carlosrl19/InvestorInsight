<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoneylenderLoans\StoreRequest;
use App\Http\Requests\MoneylenderLoans\UpdateRequest;
use App\Models\MoneylenderLoans;

class MoneylenderLoansController extends Controller
{

    public function index()
    {
        $moneylenderLoans = MoneylenderLoans::latest(20)->get();

        return view('modules.moneylender_loans.index', compact('moneylenderLoans'));
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        //
    }

    public function show(MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function edit(MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function update(UpdateRequest $request, MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function destroy(MoneylenderLoans $moneylenderLoans)
    {
        //
    }
}
