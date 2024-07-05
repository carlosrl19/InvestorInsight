<?php

namespace App\Http\Controllers;

use App\Models\PaymentInvestor;
use App\Models\Investor;
use App\Models\Project;
use App\Models\PromissoryNote;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PaymentInvestor\StoreRequest;

class PaymentInvestorController extends Controller
{
    public function index()
    {
        $payments = PaymentInvestor::with(['promissoryNoteInvestor.investor'])->get();
        $promissoryNoteInvestors = PromissoryNote::get();
        
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        $total_investor_balance = Investor::sum('investor_balance');
        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
        ->sum('promissoryNoteCommissioner_amount');

        return view('modules.payment_investors.index', compact('payments', 'promissoryNoteInvestors', 'todayDate', 'total_investor_balance', 'total_project_investment', 'total_commissioner_commission_payment'));
    }

    public function store(StoreRequest $request)
    {
        // Guardar el nuevo pago
        $paymentInvestor = PaymentInvestor::create($request->validated());

        // Actualizar el estado del pagaré correspondiente
        $promissoryNote = PromissoryNote::findOrFail($request->promissoryNote_id);
        $promissoryNote->update(['promissoryNote_status' => 0]);

        return redirect()->route('payments_investor.index')->with('success', 'Pago registrado correctamente.');
    }
}
