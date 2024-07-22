<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transfer\StoreRequest;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Cache;    
use App\Models\Transfer;
use App\Models\Project;
use App\Models\Investor;
use App\Models\InvestorFunds;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransferController extends Controller
{
    public function index()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);

        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        $investors = Cache::remember('investors', $cacheTime, function () {
            return Investor::orderBy('investor_name')->get();
        });
    
        $transfers = Cache::remember('transfers', $cacheTime, function () {
            return Transfer::where('transfer_bank', '!=', 'FONDOS')->get();
        });
    
        $generatedCode = strtoupper(Str::random(12)); // Este valor se genera cada vez
    
        $total_project_investment = Cache::remember('total_project_investment', $cacheTime, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });
    
        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', $cacheTime, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });
    
        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });
    
        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', $cacheTime, function () {
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

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;
    
        return view('modules.transfer.index', compact(
            'investors',
            'transfers',
            'generatedCode',
            'total_project_investment',
            'total_project_investment_terminated',
            'total_commissioner_commission_payment',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid',
            'loadTime'
        ));
    }

    public function create()
    {
        return view('modules.transfer._create');
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
    
        try {
            // Encuentra al inversionista por su ID
            $investor = Investor::findOrFail($request->investor_id);
            $generatedCode = strtoupper(Str::random(12)); // Genera un código aleatorio de 12 caracteres
    
            // Procesar y guardar las imágenes
            $imageNames = [];
            if ($request->hasFile('transfer_img')) {
                $images = $request->file('transfer_img');
                foreach ($images as $image) {
                    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/transfers'), $imageName);
                    $imageNames[] = $imageName;
                }
            }
    
            // Convierte el array de nombres de imágenes a JSON
            $transferImg = !empty($imageNames) ? json_encode($imageNames) : null;
    
            // Crea la nueva transferencia
            $transfer = Transfer::create([
                'transfer_code' => $generatedCode,
                'transfer_bank' => $request->transfer_bank,
                'investor_id' => $request->investor_id,
                'transfer_date' => $request->transfer_date,
                'transfer_img' => $transferImg,
                'transfer_amount' => $request->transfer_amount,
                'transfer_comment' => $request->transfer_comment,
            ]);
    
            // Se registra el cambio en el fondo del inversionista
            $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
         
            // Guarda los fondos anteriores antes de actualizar
            $oldFunds = $investor->investor_balance;
             
            // Obtén los datos validados y añade los campos necesarios para InvestorFunds
            $validatedData = $request->validated();
            $validatedData['investor_id'] = $investor->id;
            $validatedData['investor_change_date'] = $todayDate;
            $validatedData['investor_old_funds'] = $oldFunds;
            $validatedData['investor_new_funds'] = $investor->investor_balance + $request->transfer_amount;
            $validatedData['investor_new_funds_comment'] = "TRANSFERENCIA MEDIANTE " . $request->transfer_bank . " - CÓDIGO #" . $generatedCode . '.';
    
            // Crea el registro en InvestorFunds usando create
            InvestorFunds::create($validatedData);
        
            // Actualiza el saldo del inversionista sumando el monto de la transferencia
            $newBalance = $investor->investor_balance + $request->transfer_amount;
            $investor->update(['investor_balance' => $newBalance]);
    
            DB::commit();
    
            return redirect()->route('transfer.index')->with('success', 'Transferencia creada exitosamente.');
        
        } catch (\Exception $e) {
            DB::rollBack();

            // Get errors
            //dd($e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Ocurrió un error inesperado al intentar guardar la transferencia. Asegúrese de completar todos los campos del formulario. Si el problema persiste, contacte al servicio técnico.'])->withInput();
        }
    }
    
}
