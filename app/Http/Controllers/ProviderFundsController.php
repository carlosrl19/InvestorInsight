<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderFunds\StoreProviderRequest;
use App\Http\Requests\ProviderFunds\UpdateRequest;
use App\Models\ProviderFunds;

class ProviderFundsController extends Controller
{

    public function index()
    {
        $provider_funds = Providerfunds::get();
        return view("modules.provider_funds.index", compact("provider_funds"));
    }

    public function create()
    {
        //
    }


    public function store(StoreProviderRequest $request)
    {
        ProviderFunds::create($request->validated());
        return redirect()->route("provider_funds.index")->with("success","Fondo registrado exitosamente.");
    }

    public function show($id)
    {
        $provider_fund = ProviderFunds::findOrFail($id);

        return view("modules.provider_funds.show", compact("provider_fund"));
    }

    public function edit(ProviderFunds $providerFunds)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy(ProviderFunds $providerFunds)
    {
        //
    }
}
