<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestorLiquidations\StoreInvestorLiquidationsRequest;
use App\Models\InvestorLiquidations;
use Luecano\NumeroALetras\NumeroALetras;
use App\Models\Investor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

class InvestorLiquidationsController extends Controller
{
    public function index()
    {
        $investorLiquidations = Investor::where('investor_status', 3)->latest(20)->get();

        return view('modules.investors_liquidations.index', compact('investorLiquidations'));
    }

    public function create()
    {
        return view('modules.investors_liquidations.index', compact('investorFunds'));
    }

    public function store(StoreInvestorLiquidationsRequest $request)
    {
        InvestorLiquidations::create($request->all());
        return redirect()->route('investors_liquidations.index')->with('success', 'Nuevo fondo actualizado exitosamente.');
    }    
}
