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

    public function downloadVoucher($id)
    {
        $investor_liquidation = InvestorLiquidations::findOrFail($id);
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
    
        $change_date = $investor_liquidation->provider_change_date;
        $day = Carbon::parse($change_date)->format('d');
        $month = Carbon::parse($change_date)->translatedFormat('F');
        $year = Carbon::parse($change_date)->format('Y');
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
    
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
    
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Formateador de números a letras
        $formatter = new NumeroALetras();
        $valorLetras = $formatter->toWords($investor_liquidation->investor_liquidation_amount);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.investors_liquidations._report', compact('investor_liquidation', 'todayDate', 'day', 'month', 'year', 'valorLetras')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
    
        // Crear el nombre del archivo con el formato deseado
        $file_name = 'COMPROBANTE DE LIQUIDACIÓN.pdf';
    
        // Devolver el PDF para descarga forzada
        return response()->streamDownload(function () use ($pdf, $investor_liquidation) {
            echo $pdf->output();
        }, $file_name);
    }
    
}
