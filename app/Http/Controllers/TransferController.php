<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transfer\StoreRequest;
use Illuminate\Support\Facades\DB;      
use App\Models\Transfer;
use App\Models\Investor;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function index()
    {
        $investors = Investor::get();
        $transfers = Transfer::get();
        $generatedCode = strtoupper(Str::random(12));
        return view('modules.transfer.index', compact('investors', 'transfers', 'generatedCode'));
    }

    public function create()
    {
        return view('modules.transfer._create');
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
    
        try {
            // Encuentra al inversionista por su ID
            $investor = Investor::findOrFail($request->investor_id);
            $generatedCode = strtoupper(Str::random(12)); // Genera un código aleatorio de 12 caracteres

            // Crea la nueva transferencia
            $transfer = Transfer::create([
                'transfer_code' => $generatedCode,
                'transfer_bank' => $request->transfer_bank,
                'investor_id' => $request->investor_id,
                'transfer_date' => $request->transfer_date,
                'transfer_amount' => $request->transfer_amount,
                'transfer_comment' => $request->transfer_comment,
            ]);
    
            // Actualiza el saldo del inversionista sumando el monto de la transferencia
            $newBalance = $investor->investor_balance + $request->transfer_amount;
            $investor->update(['investor_balance' => $newBalance]);
    
            DB::commit();
    
            return redirect()->route('transfer.index')->with('success', 'Transferencia creada exitosamente.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Get errors
            //dd($e->getMessage());
            
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error inesperado al intentar guardar la transferencia. Si el problema persiste, contacte al servicio técnico.'])->withInput();
        }
    }

    public function show(Transfer $transfer)
    {
        //
    }
}
