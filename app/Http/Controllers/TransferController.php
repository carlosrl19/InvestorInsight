<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transfer\StoreRequest;
use App\Http\Requests\Transfer\UpdateRequest;
use App\Models\Transfer;
use App\Models\Investor;

class TransferController extends Controller
{
    public function index()
    {
        $investors = Investor::get();
        $transfers = Transfer::get();
        return view('modules.transfer.index', compact('investors', 'transfers'));
    }

    public function create()
    {
        return view('modules.transfer._create');
    }

    public function store(StoreRequest $request)
    {
        Transfer::create($request->all());
        return redirect()->route('transfer.index')->with('success', 'Transferencia creada exitosamente.');
    }

    public function show(Transfer $transfer)
    {
        //
    }

    public function edit(Transfer $transfer)
    {
        //
    }

    public function update(UpdateRequest $request, Transfer $transfer)
    {
        //
    }

    public function destroy(Transfer $transfer)
    {
        //
    }
}
