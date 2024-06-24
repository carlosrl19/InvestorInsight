<?php

namespace App\Http\Controllers;

use App\Models\InvestorFunds;
use App\Http\Requests\InvestorFunds\StoreInverstorFundsRequest;
use App\Http\Requests\InvestorFunds\UpdateRequest;

class InvestorFundsController extends Controller
{

    public function index()
    {
        $investorFunds = InvestorFunds::latest(20)->get();

        return view('modules.investors_funds.index', compact('investorFunds'));
    }

    public function create()
    {
        return view('modules.investors_funds.index', compact('investorFunds'));
    }

    public function store(StoreInverstorFundsRequest $request)
    {
        InvestorFunds::create($request->all());
        return redirect()->route('investors_funds.index')->with('success', 'Nuevo fondo actualizado exitosamente.');
    }

    public function show(InvestorFunds $investorFunds)
    {
        //
    }

    public function edit(InvestorFunds $investorFunds)
    {
        //
    }


    public function update($id)
    {
        //
    }


    public function destroy(InvestorFunds $investorFunds)
    {
        //
    }
}
