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

    public function showReport() {
        // Configurar el locale en Carbon
        Carbon::setLocale('es');

        // Obtener la fecha actual en español
        $fecha = Carbon::now()->setTimezone('America/Costa_Rica');
        $dia = $fecha->format('d');
        $mes = $fecha->translatedFormat('F'); // 'F' para nombre completo del mes
        $año = $fecha->format('Y');
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
        
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.investors_liquidations._report', compact('dia', 'mes', 'año')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
    
        // Devolver el PDF en línea
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="PDF NOTA CRÉDITO.pdf"');
    }
}
