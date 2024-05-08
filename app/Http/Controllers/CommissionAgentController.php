<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommissionAgent\StoreRequest;
use App\Http\Requests\CommissionAgent\UpdateRequest;
use App\Models\CommissionAgent;

class CommissionAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commission_agents = CommissionAgent::get();
        return view('modules.commission_agent.index', compact('commission_agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        CommissionAgent::create($request->all());
        return redirect()->route('commission_agent.index')->with('success', 'Comisionista creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommissionAgent $commissionAgent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommissionAgent $commissionAgent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, CommissionAgent $commissionAgent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommissionAgent $commissionAgent)
    {
        //
    }
}
