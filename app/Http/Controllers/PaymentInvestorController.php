<?php

namespace App\Http\Controllers;

use App\Models\PaymentInvestor;
use App\Models\Investor;
use App\Models\CommissionAgent;
use App\Models\PromissoryNote;
use App\Models\PromissoryNoteCommissioner;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Requests\PaymentInvestor\StoreRequest;

class PaymentInvestorController extends Controller
{
    public function index()
    {
        $payments = PaymentInvestor::with(['promissoryNoteInvestor.investor'])->get();
        $promissoryNoteInvestors = PromissoryNote::get();
        $promissoryNoteCommissioners = PromissoryNoteCommissioner::get();
        
        $generatedCode = strtoupper(Str::random(12)); // Random code
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');

        return view('modules.payment_investors.index', compact('payments', 'promissoryNoteInvestors', 'todayDate', 'promissoryNoteCommissioners', 'generatedCode', 'total_investor_balance', 'total_commissioner_balance'));
    }

    public function store(StoreRequest $request)
    {
        // Guardar el nuevo pago
        $paymentInvestor = PaymentInvestor::create($request->validated());

        // Actualizar el estado del pagaré correspondiente
        $promissoryNote = PromissoryNote::findOrFail($request->promissoryNoteInvestor_id);
        $promissoryNote->update(['promissoryNote_status' => 0]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('payments_investor.index')->with('success', 'Pago registrado y pagaré actualizado correctamente.');
    }
}
