<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use App\Models\Provider;
use App\Models\Investor;
use App\Models\CommissionAgent;

class ProviderController extends Controller
{

    public function index()
    {
        $providers = Provider::get();
        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');

        return view("modules.providers.index", compact("providers", "total_investor_balance", "total_commissioner_balance"));
    }

    public function create()
    {
        //
    }


    public function store(StoreRequest $request)
    {
        Provider::create($request->all());

        return redirect()->route("provider.index")->with("success","Proveedor creado exitosamente.");
    }

    public function show($id)
    {
        $provider = Provider::findOrFail($id);
        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');

        return view("modules.providers.show", compact("provider", "total_investor_balance", "total_commissioner_balance"));
    }

    public function edit($id)
    {
        $provider = Provider::findOrFail($id);
        return view('modules.investors.index', compact('provider'));
    }

    public function update(UpdateRequest $request, Provider $provider)
    {
        $provider->update($request->all());
        return redirect()->route("provider.index")->with("success", "Proveedor actualizado exitosamente.");
    }

    public function destroy($id)
    {
        Provider::destroy($id);
        return redirect()->route('provider.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
