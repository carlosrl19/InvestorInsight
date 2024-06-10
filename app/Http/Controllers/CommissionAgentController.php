<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommissionAgent\StoreRequest;
use App\Http\Requests\CommissionAgent\UpdateRequest;
use App\Models\CommissionAgent;
use App\Models\Investor;

class CommissionAgentController extends Controller
{

    public function index()
    {
        $commission_agents = CommissionAgent::get();
        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');
        $commissioner_balance = 0.00;
        $commissioner_balance = 0.00;

        $lastCommissioner = CommissionAgent::latest()->first();
        $nextId = $lastCommissioner ? $lastCommissioner->id + 1 : 1;
        $commissionerCode = str_pad($nextId, 8, '0', STR_PAD_LEFT);

        return view('modules.commission_agent.index', compact('commission_agents', 'total_investor_balance', 'total_commissioner_balance', 'commissioner_balance', 'commissionerCode'));
    }


    public function create()
    {
        //
    }


    public function store(StoreRequest $request)
    {

        CommissionAgent::create($request->all());
        return redirect()->route('commission_agent.index')->with('success', 'Comisionista creado exitosamente.');
    }


    public function show(CommissionAgent $commissionAgent)
    {
        //
    }


    public function edit($id)
    {
        $commission_agent = CommissionAgent::findOrFail($id);
        return view('modules.commission_agent.index', compact('commission_agent'));
    }    


    public function update(UpdateRequest $request, CommissionAgent $commissionAgent)
    {
        $commissionAgent->update($request->all());
        return redirect()->route("commission_agent.index")->with("success", "Comisionista actualizado exitosamente.");
    }

    public function destroy($id)
    {
        $commissionAgent = CommissionAgent::find($id);
    
        if (($commissionAgent->id == 1 || $commissionAgent->commissioner_name == 'JUNIOR AYALA')) {
            return redirect()->route('commission_agent.index')->with('error', 'No se puede eliminar a Junior Ayala de los comisionistas.');
        }
    
        $commissionAgent->delete();
    
        return redirect()->route('commission_agent.index')->with('success', 'Comisionista eliminado exitosamente.');
    }
}
