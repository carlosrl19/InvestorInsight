<?php

namespace App\Http\Controllers;

use App\Http\Requests\Investor\StoreRequest;
use App\Http\Requests\Investor\UpdateRequest;
use App\Models\CommissionAgent;
use App\Models\CreditNote;
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
        $creditNotes = CreditNote::where('investor_id', $investor->id)->orderBy('creditNote_date')->get();
    
        // Combine transfers and credit notes in a single collection and order them by date
        $events = collect();
    
        foreach ($transfers as $transfer) {
            $events->push((object)[
                'date' => $transfer->transfer_date,
                'type' => 'transfer',
                'amount' => $transfer->transfer_amount,
                'description' => $transfer->transfer_description,
                'bank' => $transfer->transfer_bank,
                'original_model' => $transfer
            ]);
        }
    
        foreach ($creditNotes as $creditNote) {
            $events->push((object)[
                'date' => $creditNote->creditNote_date,
                'type' => 'creditNote',
                'amount' => -$creditNote->creditNote_amount,
                'description' => $creditNote->creditNote_description,
                'bank' => null,
                'original_model' => $creditNote
            ]);
        }
    
        $events = $events->sortBy('date');
    
        // Calculate the current balance from zero, reflecting all transactions
        $currentBalance = 0;
        foreach ($events as $event) {
            $currentBalance += $event->amount;
            $event->current_balance = $currentBalance;
        }
    
        // Separate the events into transfers and credit notes again for displaying in tables
        $transfers = $events->where('type', 'transfer')->map(function ($event) {
            $transfer = $event->original_model;
            $transfer->current_balance = $event->current_balance;
            return $transfer;
        });
    
        $creditNotes = $events->where('type', 'creditNote')->map(function ($event) {
            $creditNote = $event->original_model;
            $creditNote->current_balance = $event->current_balance;
            return $creditNote;
        });
    
        return view('modules.investors.show', compact('investor', 'transfers', 'creditNotes'));
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
