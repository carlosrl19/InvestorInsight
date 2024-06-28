<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderFunds\StoreProviderRequest;
use App\Http\Requests\ProviderFunds\UpdateRequest;
use App\Models\ProviderFunds;

class ProviderFundsController extends Controller
{

    public function index()
    {
        $provider_funds = Providerfunds::all();
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

    public function show(ProviderFunds $providerFunds)
    {
        //
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
