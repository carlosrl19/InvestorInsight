<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoneylenderLoans\StoreRequest;
use App\Http\Requests\MoneylenderLoans\UpdateMoneylenderLoansRequest;
use App\Models\MoneylenderLoans;

class MoneylenderLoansController extends Controller
{
    public function index()
    {
        $loans = MoneylenderLoans::get();

        return view("modules.moneylender_loans._index", compact("loans"));
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        MoneylenderLoans::create($request->all());
        return redirect()->route('moneylender.index')->with('success', 'Prestamo creado exitosamente.');
    }

    public function show(MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function edit(MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function update(UpdateMoneylenderLoansRequest $request, MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function destroy(MoneylenderLoans $moneylenderLoans)
    {
        //
    }
}
