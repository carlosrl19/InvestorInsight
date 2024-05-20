<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Project;
use App\Models\CommissionAgent;
use App\Models\Transfer;
use App\Models\CreditNote;

class DashboardController extends Controller
{
    public function index(){
        $investors = Investor::count();
        $commissioner = CommissionAgent::count();
        $transfers = Transfer::latest()->take(15)->get();
        $creditNotes = CreditNote::latest()->take(15)->get();

        return view('modules.dashboard.index', compact('investors', 'commissioner', 'transfers', 'creditNotes'));
    }
}
