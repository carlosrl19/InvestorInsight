<?php

namespace App\Http\Controllers;

use App\Models\PaymentInvestor;
use App\Models\Project;
use App\Models\PromissoryNote;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use App\Http\Requests\PaymentInvestor\StoreRequest;

use Carbon\Carbon;
use Dompdf\Options;
use Dompdf\Dompdf;

class PaymentInvestorController extends Controller
{
    public function index()
    {
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        $payments = Cache::remember('payments_with_investor', $cacheTime, function () {
            return PaymentInvestor::with(['promissoryNoteInvestor.investor'])->get();
        });
    
        // Obtener los códigos de proyectos activos
        $activeProjectCodes = Cache::remember('active_project_codes', $cacheTime, function () {
            return Project::where('project_status', 0)->pluck('project_code');
        });
    
        $promissoryNotes = Cache::remember('promissory_notes', $cacheTime, function () {
            return PromissoryNote::get();
        });
    
        // Filtrar los Promissory Notes que tengan un código que coincida con los códigos de proyectos activos
        $promissoryNoteInvestors = Cache::remember('promissory_note_investors', $cacheTime, function () use ($activeProjectCodes) {
            return PromissoryNote::where('promissoryNote_status', 0)
                ->whereIn('promissoryNote_code', $activeProjectCodes)
                ->get();
        });
    
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
    
        $total_project_investment = Cache::remember('total_project_investment_active', $cacheTime, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });
    
        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', $cacheTime, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });
    
        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment_active', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });
    
        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment_active', $cacheTime, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });
    
        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', $cacheTime, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });
    
        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });
    
        return view('modules.payment_investors.index', compact(
            'payments',
            'promissoryNotes',
            'promissoryNoteInvestors',
            'todayDate',
            'total_project_investment',
            'total_project_investment_terminated',
            'total_commissioner_commission_payment',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid'
        ));
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

    public function showReport($id) {
        $paymentInvestor = PaymentInvestor::findOrFail($id);
    
        // Obtener el investor_final_profit del project_investor asociado usando DB::table
        $projectInvestor = DB::table('project_investor')
            ->where('project_id', $paymentInvestor->project_id)
            ->where('investor_id', $paymentInvestor->investor_id)
            ->first();
    
        // Obtener los datos del proyecto asociado al payment_investor
        $project = DB::table('projects')
            ->where('id', $paymentInvestor->project_id)
            ->first();
    
        // Configurar el locale en Carbon
        Carbon::setLocale('es');
    
        // Obtener la fecha actual en español
        $fecha = Carbon::now()->setTimezone('America/Costa_Rica');
        $dia = $fecha->format('d');
        $mes = $fecha->translatedFormat('F'); // 'F' para nombre completo del mes
        $anio = $fecha->format('Y');
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('chroot', realpath(''));
    
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.payment_investors._report', compact('paymentInvestor', 'projectInvestor', 'project', 'dia', 'mes', 'anio')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
    
        // Devolver el PDF en línea
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="PDF REPORTE DE PAGO.pdf"');
    }      
}