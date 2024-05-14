<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;      
use App\Models\CreditNote;
use App\Http\Requests\CreditNote\StoreRequest;
use App\Models\Investor;

class CreditNoteController extends Controller
{
    public function index()
    {
        $creditNotes = CreditNote::get();
        $investors = Investor::get();
        return view ("modules.credit_note.index", compact("creditNotes", "investors"));
    }

    public function create()
    {
        return view('modules.credit_note._create');
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
    
        try {
            // Encuentra al inversionista por su ID
            $investor = Investor::findOrFail($request->investor_id);
            
            // Crea la nueva nota crédito
            $transfer = CreditNote::create([
                'creditNote_date' => $request->creditNote_date,
                'investor_id' => $request->investor_id,
                'creditNote_amount' => $request->creditNote_amount,
                'creditNote_description' => $request->creditNote_description,
            ]);
    
            // Actualiza el saldo del inversionista restando el monto de la nota crédito
            $newBalance = $investor->investor_balance - $request->creditNote_amount;
            $investor->update(['investor_balance' => $newBalance]);
    
            DB::commit();
    
            return redirect()->route('credit_note.index')->with('success', 'Nota crédito creada exitosamente.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Get errors
            //dd($e->getMessage());
            
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error inesperado al intentar guardar la transferencia. Si el problema persiste, contacte al servicio técnico.'])->withInput();
        }
    }

    public function show(CreditNote $creditNote)
    {
        //
    }
}
