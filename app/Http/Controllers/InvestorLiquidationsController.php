<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestorLiquidations\StoreInvestorLiquidationsRequest;
use App\Models\InvestorLiquidations;
use App\Models\Investor;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;

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

    public function showLiquidation($id) {
        $investorLiquidation = InvestorLiquidations::findOrFail($id);
        $investorId = $investorLiquidation->investor_id;
        $investor = Investor::findOrFail($investorId);
    
        $balanceToLiquidate = $investor->liquidation_payment_amount;
    
        // Configurar el locale en Carbon
        Carbon::setLocale('es');
    
        // Obtener la fecha actual en español
        $fecha = Carbon::now()->setTimezone('America/Costa_Rica');
        $day = $fecha->format('d');
        $month = $fecha->format('m');
        $monthSpanish = $fecha->translatedFormat('F');
        $year = $fecha->format('Y');
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
    
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
    
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.investors_liquidations._report_liquidation', compact('investorLiquidation', 'investor', 'day', 'month', 'year', 'balanceToLiquidate')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
        
        $fileName = $investorLiquidation->investor->investor_name . ' - LIQUIDACIÓN (' . $day . '-' . $monthSpanish . '-' . $year . ').pdf';

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $fileName . '"');
    }

    public function downloadLiquidation($id) {
        $investorLiquidation = InvestorLiquidations::findOrFail($id);
        $investorId = $investorLiquidation->investor_id;
        $investor = Investor::findOrFail($investorId);
    
        $balanceToLiquidate = $investor->liquidation_payment_amount;
    
        // Configurar el locale en Carbon
        Carbon::setLocale('es');
    
        // Obtener la fecha actual en español
        $fecha = Carbon::now()->setTimezone('America/Costa_Rica');
        $day = $fecha->format('d');
        $month = $fecha->format('m');
        $monthSpanish = $fecha->translatedFormat('F');
        $year = $fecha->format('Y');
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
    
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
    
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.investors_liquidations._report_liquidation', compact('investorLiquidation', 'investor', 'day', 'month', 'year', 'balanceToLiquidate')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
        
        $fileName = $investorLiquidation->investor->investor_name . ' - LIQUIDACIÓN (' . $day . '-' . $monthSpanish . '-' . $year . ').pdf';

        // Devolver el PDF para descarga forzada
        return response()->streamDownload(function () use ($pdf, $investorLiquidation) {
            echo $pdf->output();
        }, $fileName);
    }
}
