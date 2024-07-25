<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;      
use Illuminate\Support\Facades\Cache;      

use App\Http\Requests\CreditNote\StoreRequest;

use App\Models\CreditNote;
use App\Models\Investor;
use App\Models\InvestorFunds;
use App\Models\Project;

use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;

class CreditNoteController extends Controller
{
    public function index()
    {
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        $creditNotes = Cache::remember('credit_notes', $cacheTime, function () {
            return CreditNote::get();
        });
    
        $investors = Cache::remember('investors_ordered', $cacheTime, function () {
            return Investor::orderBy('investor_name')->get();
        });
    
        $creditNoteCode = strtoupper(Str::random(12)); // Credit note random code
        $creditNoteDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
    
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
    
        return view('modules.credit_note.index', compact(
            'creditNotes',
            'investors',
            'creditNoteCode',
            'creditNoteDate',
            'total_project_investment',
            'total_project_investment_terminated',
            'total_commissioner_commission_payment',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid'
        ));
    }    

    public function create()
    {
        return view('modules.credit_note._create');
    }

    public function showReport($id) {
        $creditNote = CreditNote::findOrFail($id);

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
        
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
        
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.credit_note._report', compact('creditNote', 'dia', 'mes', 'anio')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
         
        $fileName = $creditNote->investor->investor_name . ' - NOTA CRÉDITO (' . $dia . '-' . $mes . '-' . $anio . ').pdf';

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $fileName . '"');
    }
     
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
    
        try {
            // Encuentra al inversionista por su ID
            $investor = Investor::findOrFail($request->investor_id);
            $creditNoteCode = strtoupper(Str::random(12)); // Credit note random code
            $creditNoteDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
            
            // Crea la nueva nota crédito
            $transfer = CreditNote::create([
                'creditNote_date' => $creditNoteDate,
                'investor_id' => $request->investor_id,
                'creditNote_amount' => $request->creditNote_amount,
                'creditNote_code' => $creditNoteCode,
                'creditNote_description' => $request->creditNote_description,
            ]);

            // Verifica si el saldo del inversionista es suficiente para la nota crédito
            if ($investor->investor_balance < $request->creditNote_amount) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'El monto de la nota crédito no puede ser mayor que el fondo del inversionista.']);
            }

            // Se registra el cambio en el fondo del inversionista
            $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
     
            // Guarda los fondos anteriores antes de actualizar
            $oldFunds = $investor->investor_balance;
          
            // Obtén los datos validados y añade los campos necesarios para InvestorFunds
            $validatedData = $request->validated();
            $validatedData['investor_id'] = $investor->id;
            $validatedData['investor_change_date'] = $todayDate;
            $validatedData['investor_old_funds'] = $oldFunds;
            $validatedData['investor_new_funds'] = $investor->investor_balance - $request->creditNote_amount;
            $validatedData['investor_new_funds_comment'] = "NOTA CRÉDITO - CÓDIGO #" . $creditNoteCode . '.';
          
            // Crea el registro en InvestorFunds usando create
            InvestorFunds::create($validatedData);
    
            // Actualiza el saldo del inversionista restando el monto de la nota crédito
            $newBalance = $investor->investor_balance - $request->creditNote_amount;
            $investor->update(['investor_balance' => $newBalance]);
    
            DB::commit();
    
            return redirect()->route('credit_note.index')->with('success', 'Nota crédito creada exitosamente.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Get errors
            //dd($e->getMessage());
            
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error inesperado al intentar guardar la transferencia. Si el problema persiste, contacte al servicio técnico.'])->withInput();
        }
    }

    public function downloadReport($id) {
        $creditNote = CreditNote::findOrFail($id);

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
        
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
        
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.credit_note._report', compact('creditNote', 'dia', 'mes', 'anio')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();

        // Obtener el project_code a partir del promissoryNote_code
        $investorId = Investor::where('id', $creditNote->investor_id)->first();

        // Obtener el project_name
        $investor_name = $investorId->investor_name;
     
        // Crear el nombre del archivo con el formato deseado
        $file_name = $investor_name . ' - NOTA CRÉDITO (' . $dia . '-' . $mes . '-' . $anio . ').pdf';
 
        // Devolver el PDF para descarga forzada
        return response()->streamDownload(function () use ($pdf, $creditNote) {
            echo $pdf->output();
        }, $file_name);
    }
}
