<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentCommissioner\StoreRequest;
use App\Models\PaymentCommissioner;
use App\Models\Investor;
use App\Models\CommissionAgent;
use App\Models\PromissoryNote;
use App\Models\PromissoryNoteCommissioner;
use Carbon\Carbon;

class PaymentCommissionerController extends Controller
{
    public function index()
    {
        $payments = PaymentCommissioner::with(['promissoryNoteCommissioner.commissioner'])->get();
        $promissoryNoteCommissioners = PromissoryNoteCommissioner::where('commissioner_id', '!=', '1')->get();

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');

        return view('modules.payment_commissioners.index', compact('payments', 'todayDate', 'promissoryNoteCommissioners', 'total_investor_balance', 'total_commissioner_balance'));
    }

    public function store(StoreRequest $request)
    {
        // Guardar el nuevo pago
        $paymentCommissioner = PaymentCommissioner::create($request->validated());

        // Actualizar el estado del pagaré correspondiente
        $promissoryNote = PromissoryNoteCommissioner::findOrFail($request->promissoryNoteCommissioner_id);
        $promissoryNote->update(['promissoryNote_status' => 0]);

        return redirect()->route('payments_commissioner.index')->with('success', 'Pago registrado correctamente.');
    }
}
