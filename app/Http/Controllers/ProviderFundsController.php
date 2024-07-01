<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderFunds\StoreProviderRequest;
use App\Models\Provider;
use App\Models\ProviderFunds;
use Luecano\NumeroALetras\NumeroALetras;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;

class ProviderFundsController extends Controller
{

    public function index()
    {
        $provider_funds = Providerfunds::get();
        return view("modules.provider_funds.index", compact("provider_funds"));
    }

    public function create()
    {
        //
    }


    public function store(StoreProviderRequest $request)
    {
        ProviderFunds::create($request->validated());
        return redirect()->route("provider_funds.index")->with("success","Fondo registrado exitosamente.");
    }

    public function show($id)
    {
        $provider_fund = ProviderFunds::findOrFail($id);

        return view("modules.provider_funds.show", compact("provider_fund"));
    }

    public function showBill($id)
    {
        $provider_fund = ProviderFunds::findOrFail($id);

        $change_date = $provider_fund->provider_change_date;
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
        $valorLetras = $formatter->toWords($provider_fund->provider_new_funds);

        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.providers._report', compact('provider_fund', 'day', 'month', 'year', 'valorLetras')));

        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $pdf->render();

       // Devolver el PDF en línea
       return response($pdf->output(), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="PDF FINIQUITO.pdf"');
    }

    public function downloadBill($id)
    {
        $provider_fund = ProviderFunds::findOrFail($id);

        $change_date = $provider_fund->provider_change_date;
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
        $valorLetras = $formatter->toWords($provider_fund->provider_new_funds);

        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.providers._report', compact('provider_fund', 'day', 'month', 'year', 'valorLetras')));

        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $pdf->render();

        $provider = Provider::where('id', $provider_fund->provider_id)->first();
        $provider_name = $provider->provider_name;
    
        // Crear el nombre del archivo con el formato deseado
        $file_name = $provider_name . ' - FACTURA.pdf';

        // Devolver el PDF para descarga forzada
        return response()->streamDownload(function () use ($pdf, $provider_fund) {
            echo $pdf->output();
        }, $file_name);
    }

    public function edit(ProviderFunds $providerFunds)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy(ProviderFunds $providerFunds)
    {
        //
    }
}
