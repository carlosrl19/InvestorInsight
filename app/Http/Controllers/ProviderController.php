<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\ProviderFunds\StoreProviderRequest;
use App\Http\Requests\Provider\UpdateRequest;
use App\Models\Provider;
use App\Models\Investor;
use App\Models\CommissionAgent;
use App\Models\ProviderFunds;
use Carbon\Carbon;

class ProviderController extends Controller
{

    public function index()
    {
        $providers = Provider::get();
        $provider_funds = ProviderFunds::get();
        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        return view("modules.providers.index", compact("providers", "todayDate", "provider_funds", "total_investor_balance", "total_commissioner_balance"));
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

    public function fund(StoreProviderRequest $request, $id)
    {
        // Encuentra el proveedor o falla si no existe
        $provider = Provider::findOrFail($id);
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        // Guarda los fondos anteriores antes de actualizar
        $oldFunds = $provider->provider_balance;
    
        // Actualiza el balance del proveedor
        $provider->provider_balance = $request->input('provider_new_funds');
        $provider->save();
    
        // Obtén los datos validados y añade los campos necesarios para InvestorFunds
        $validatedData = $request->validated();
        $validatedData['provider_id'] = $provider->id;
        $validatedData['provider_change_date'] = $todayDate;
        $validatedData['provider_old_funds'] = $oldFunds;
        $validatedData['provider_new_funds'] = $provider->provider_balance;
        $validatedData['provider_new_funds_comment'] = $request->input('provider_new_funds_comment');
    
        // Crea el registro en InvestorFunds usando create
        ProviderFunds::create($validatedData);
    
        // Redirige con un mensaje de éxito
        return redirect()->route('provider.index')->with("success", "Fondo del proveedor actualizado exitosamente.");
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
