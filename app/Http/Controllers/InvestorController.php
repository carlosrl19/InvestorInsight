<?php

namespace App\Http\Controllers;

use App\Http\Requests\Investor\StoreRequest;
use App\Http\Requests\Investor\UpdateRequest;
use App\Models\Investor;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investor = Investor::get();
        return view('modules.investors.index', compact('investor'));
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
        Investor::create($request->all());
        return redirect()->route('investor.index')->with('success', 'Inversionista creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Investor $investor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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
