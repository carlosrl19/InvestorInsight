<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Investor;
use App\Models\CommissionAgent;
use App\Models\PromissoryNote;
use App\Models\PromissoryNoteCommissioner;

class PaymentController extends Controller
{
    public function index(){
        $payments = Payment::get();
        $promissoryNoteInvestors = PromissoryNote::get();
        $promissoryNoteCommissioners = PromissoryNoteCommissioner::get();

        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');

        return view('modules.payments.index', compact('payments', 'promissoryNoteInvestors', 'promissoryNoteCommissioners', 'total_investor_balance', 'total_commissioner_balance'));
    }
}
