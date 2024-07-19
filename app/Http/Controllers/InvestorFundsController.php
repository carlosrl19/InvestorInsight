<?php

namespace App\Http\Controllers;

use App\Models\InvestorFunds;
use App\Http\Requests\InvestorFunds\StoreInverstorFundsRequest;
use App\Models\Investor;
use App\Exports\InvestorFundsExport;
use Maatwebsite\Excel\Facades\Excel;

class InvestorFundsController extends Controller
{

    public function index()
    {
        $investorFunds = InvestorFunds::latest(20)->get();

        return view('modules.investors_funds.index', compact('investorFunds'));
    }

    public function create()
    {
        return view('modules.investors_funds.index', compact('investorFunds'));
    }

    public function store(StoreInverstorFundsRequest $request)
    {
        InvestorFunds::create($request->all());
        return redirect()->route('investors_funds.index')->with('success', 'Nuevo fondo actualizado exitosamente.');
    }

    public function export($id)
    {
        $investor = Investor::findOrFail($id);
        $investorName = $investor->investor_name;

        return Excel::download(new InvestorFundsExport($id), $investorName . ' - HISTORIAL DE MOVIMIENTOS EN FONDOS.xlsx');        
    }
}
