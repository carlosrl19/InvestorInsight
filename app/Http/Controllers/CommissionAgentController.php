<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommissionAgent\StoreRequest;
use App\Http\Requests\CommissionAgent\UpdateRequest;
use App\Models\CommissionAgent;

class CommissionAgentController extends Controller
{

    public function index()
    {
        $commission_agents = CommissionAgent::get();
        return view('modules.commission_agent.index', compact('commission_agents'));
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
        return view('modules.commission_agent.update', compact('commission_agent'));
    }    


    public function update(UpdateRequest $request, CommissionAgent $commissionAgent)
    {
        $commissionAgent->update($request->all());
        return redirect()->route("commission_agent.index")->with("success", "Comisionista actualizado exitosamente.");
    }


    public function destroy($id)
    {
        CommissionAgent::destroy($id);
        return redirect()->route('commission_agent.index')->with('success', 'Comisionista eliminado exitosamente.');
    }
}