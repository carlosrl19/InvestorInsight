<?php

namespace App\Http\Controllers;

use App\Http\Requests\Investor\StoreRequest;
use App\Http\Requests\Investor\UpdateRequest;
use App\Models\Investor;

class InvestorController extends Controller
{

    public function index()
    {
        $investor = Investor::get();
        return view('modules.investors.index', compact('investor'));
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


    public function show(Investor $investor)
    {
        //
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
