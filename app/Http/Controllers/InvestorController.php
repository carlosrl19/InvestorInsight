<?php

namespace App\Http\Controllers;

use App\Http\Requests\Investor\StoreRequest;
use App\Http\Requests\Investor\UpdateRequest;
use App\Models\CommissionAgent;
use App\Models\Investor;
use App\Models\Transfer;

class InvestorController extends Controller
{

    public function index()
    {
        $investors = Investor::get();
        $commissioners = CommissionAgent::get();
        return view('modules.investors.index', compact('investors', 'commissioners'));
    }


    public function create()
    {
        //
    }


    public function store(StoreRequest $request)
    {
        Investor::create($request->all());
        return redirect()->route('investor.index')->with('success', 'Inversionista creado exitosamente.');
    }

    public function show($id)
    {
        $investor = Investor::findOrFail($id);
        $transfers = Transfer::where('investor_id', $investor->id)->orderBy('transfer_date')->get();
        
        $currentBalance = $investor->investor_balance; // Saldo inicial
        
        foreach ($transfers as $transfer) {
            // Calcula el nuevo saldo sumando o restando el monto de la transferencia
            $transfer->current_balance = $currentBalance += $transfer->transfer_amount;
        }
        
        return view('modules.investors.show', compact('investor', 'transfers'));
    }
    

    public function edit($id)
    {
        $investor = Investor::findOrFail($id);
        return view('modules.investors.update', compact('investor'));
    }    

    public function update(UpdateRequest $request, Investor $investor)
    {
        $investor->update($request->all());
        return redirect()->route("investor.index")->with("success", "Inversionista actualizado exitosamente.");
    }

    public function destroy($id)
    {
        Investor::destroy($id);
        return redirect()->route('investor.index')->with('success', 'Inversionista eliminado exitosamente.');
    }
}
