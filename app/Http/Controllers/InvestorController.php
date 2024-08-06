<?php

namespace App\Http\Controllers;

use App\Http\Requests\Investor\StoreRequest;
use App\Http\Requests\Investor\UpdateRequest;
use App\Http\Requests\InvestorFunds\StoreInverstorFundsRequest;
use App\Http\Requests\InvestorLiquidations\StoreInvestorLiquidationsRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use App\Models\CommissionAgent;
use App\Models\CreditNote;
use App\Models\Investor;
use App\Models\InvestorFunds;
use App\Models\InvestorLiquidations;
use App\Models\Transfer;
use App\Models\Project;

use Carbon\Carbon;
use Dompdf\Options;
use Dompdf\Dompdf;

class InvestorController extends Controller
{
    // Index to all investors
    public function index()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);

        // Verificar que se está usando Memcached
        if (Cache::getStore() instanceof \Illuminate\Cache\MemcachedStore) {
            Log::info('Using Memcached');
        } else {
            Log::info('Not using Memcached');
        }

        $investors = Cache::remember('investors', 60, function () {
            return Investor::orderBy('investor_name')->get();
        });

        $commissioners = Cache::remember('commissioners', 60, function () {
            return CommissionAgent::get();
        });

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
        $generatedCode = strtoupper(Str::random(12)); // Random code

        $total_project_investment = Cache::remember('total_project_investment', 60, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });

        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', 60, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });

        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });

        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });

        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });

        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });

        // Mapeamos los investors para obtener sus referencias
        $investors = $investors->map(function ($investor) {
            $investor->investor_reference = Cache::remember('investor_reference_' . $investor->investor_reference_id, 60, function () use ($investor) {
                return Investor::find($investor->investor_reference_id);
            });
            return $investor;
        });

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

        // Pasar el tiempo de carga a la vista
        return view(
            'modules.investors.index',
            compact(
                'investors',
                'generatedCode',
                'todayDate',
                'commissioners',
                'total_project_investment',
                'total_project_investment_terminated',
                'total_commissioner_commission_payment',
                'total_investor_profit_payment',
                'total_investor_profit_paid',
                'total_commissioner_commission_paid',
                'loadTime' // Agregar el tiempo de carga
            )
        );
    }

    // Index to Future Capital investors
    public function indexFutureCapital()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);

        // Verificar que se está usando Memcached
        if (Cache::getStore() instanceof \Illuminate\Cache\MemcachedStore) {
            Log::info('Using Memcached');
        } else {
            Log::info('Not using Memcached');
        }

        $investors = Cache::remember('investors_future_capital', 60, function () {
            return Investor::where('investor_company_name', 'FUTURE CAPITAL')->orderBy('investor_name')->get();
        });

        $commissioners = Cache::remember('commissioners', 60, function () {
            return CommissionAgent::get();
        });

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
        $generatedCode = strtoupper(Str::random(12)); // Random code

        $total_project_investment = Cache::remember('total_project_investment', 60, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });

        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', 60, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });

        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });

        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });

        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });

        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });

        // Mapeamos los investors para obtener sus referencias
        $investors = $investors->map(function ($investor) {
            $investor->investor_reference = Cache::remember('investor_reference_' . $investor->investor_reference_id, 60, function () use ($investor) {
                return Investor::find($investor->investor_reference_id);
            });
            return $investor;
        });

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

        // Pasar el tiempo de carga a la vista
        return view(
            'modules.investors.index',
            compact(
                'investors',
                'generatedCode',
                'todayDate',
                'commissioners',
                'total_project_investment',
                'total_project_investment_terminated',
                'total_commissioner_commission_payment',
                'total_investor_profit_payment',
                'total_investor_profit_paid',
                'total_commissioner_commission_paid',
                'loadTime' // Agregar el tiempo de carga
            )
        );
    }

    // Index to Jaguer investors
    public function indexJaguer()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);

        // Verificar que se está usando Memcached
        if (Cache::getStore() instanceof \Illuminate\Cache\MemcachedStore) {
            Log::info('Using Memcached');
        } else {
            Log::info('Not using Memcached');
        }

        $investors = Cache::remember('investors_jaguer', 60, function () {
            return Investor::where('investor_company_name', 'JAGUER')->orderBy('investor_name')->get();
        });

        $commissioners = Cache::remember('commissioners', 60, function () {
            return CommissionAgent::get();
        });

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
        $generatedCode = strtoupper(Str::random(12)); // Random code

        $total_project_investment = Cache::remember('total_project_investment', 60, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });

        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', 60, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });

        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });

        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });

        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });

        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });

        // Mapeamos los investors para obtener sus referencias
        $investors = $investors->map(function ($investor) {
            $investor->investor_reference = Cache::remember('investor_reference_' . $investor->investor_reference_id, 60, function () use ($investor) {
                return Investor::find($investor->investor_reference_id);
            });
            return $investor;
        });

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

        // Pasar el tiempo de carga a la vista
        return view(
            'modules.investors.index',
            compact(
                'investors',
                'generatedCode',
                'todayDate',
                'commissioners',
                'total_project_investment',
                'total_project_investment_terminated',
                'total_commissioner_commission_payment',
                'total_investor_profit_payment',
                'total_investor_profit_paid',
                'total_commissioner_commission_paid',
                'loadTime' // Agregar el tiempo de carga
            )
        );
    }

    // Index to Marsella investors
    public function indexMarsella()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);

        // Verificar que se está usando Memcached
        if (Cache::getStore() instanceof \Illuminate\Cache\MemcachedStore) {
            Log::info('Using Memcached');
        } else {
            Log::info('Not using Memcached');
        }

        $investors = Cache::remember('investors_marsella', 60, function () {
            return Investor::where('investor_company_name', 'MARSELLA')->orderBy('investor_name')->get();
        });

        $commissioners = Cache::remember('commissioners', 60, function () {
            return CommissionAgent::get();
        });

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
        $generatedCode = strtoupper(Str::random(12)); // Random code

        $total_project_investment = Cache::remember('total_project_investment', 60, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });

        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', 60, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });

        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });

        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });

        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });

        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });

        // Mapeamos los investors para obtener sus referencias
        $investors = $investors->map(function ($investor) {
            $investor->investor_reference = Cache::remember('investor_reference_' . $investor->investor_reference_id, 60, function () use ($investor) {
                return Investor::find($investor->investor_reference_id);
            });
            return $investor;
        });

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

        // Pasar el tiempo de carga a la vista
        return view(
            'modules.investors.index',
            compact(
                'investors',
                'generatedCode',
                'todayDate',
                'commissioners',
                'total_project_investment',
                'total_project_investment_terminated',
                'total_commissioner_commission_payment',
                'total_investor_profit_payment',
                'total_investor_profit_paid',
                'total_commissioner_commission_paid',
                'loadTime' // Agregar el tiempo de carga
            )
        );
    }

    // Index to Robenior investors
    public function indexRobenior()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);

        // Verificar que se está usando Memcached
        if (Cache::getStore() instanceof \Illuminate\Cache\MemcachedStore) {
            Log::info('Using Memcached');
        } else {
            Log::info('Not using Memcached');
        }

        $investors = Cache::remember('investors_robenior', 60, function () {
            return Investor::where('investor_company_name', 'ROBENIOR')->orderBy('investor_name')->get();
        });

        $commissioners = Cache::remember('commissioners', 60, function () {
            return CommissionAgent::get();
        });

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
        $generatedCode = strtoupper(Str::random(12)); // Random code

        $total_project_investment = Cache::remember('total_project_investment', 60, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });

        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', 60, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });

        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });

        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });

        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', 60, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });

        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', 60, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });

        // Mapeamos los investors para obtener sus referencias
        $investors = $investors->map(function ($investor) {
            $investor->investor_reference = Cache::remember('investor_reference_' . $investor->investor_reference_id, 60, function () use ($investor) {
                return Investor::find($investor->investor_reference_id);
            });
            return $investor;
        });

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

        // Pasar el tiempo de carga a la vista
        return view(
            'modules.investors.index',
            compact(
                'investors',
                'generatedCode',
                'todayDate',
                'commissioners',
                'total_project_investment',
                'total_project_investment_terminated',
                'total_commissioner_commission_payment',
                'total_investor_profit_payment',
                'total_investor_profit_paid',
                'total_commissioner_commission_paid',
                'loadTime' // Agregar el tiempo de carga
            )
        );
    }

    public function create()
    {
        return view('modules.investors.create');
    }

    public function store(StoreRequest $request)
    {
        Investor::create($request->all());
        return redirect()->route('investor.index')->with('success', 'Inversionista creado exitosamente.');
    }

    public function show($id)
    {
        // Iniciar el temporizador
        $startTime = microtime(true);

        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora

        $investor = Cache::remember("investor_{$id}", $cacheTime, function () use ($id) {
            return Investor::findOrFail($id);
        });

        $investorFunds = Cache::remember("investor_funds_{$id}", $cacheTime, function () use ($id) {
            return InvestorFunds::where('investor_id', '=', $id)->orderBy('created_at')->get();
        });

        $transfers = Cache::remember("transfers_{$id}", $cacheTime, function () use ($investor) {
            return Transfer::where('investor_id', $investor->id)->where('transfer_bank', '!=', 'FONDOS')->orderBy('transfer_date')->get();
        });

        $creditNotes = Cache::remember("credit_notes_{$id}", $cacheTime, function () use ($investor) {
            return CreditNote::where('investor_id', $investor->id)->orderBy('creditNote_date')->get();
        });

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

        $referenceInvestor = Cache::remember("reference_investor_{$investor->investor_reference_id}", $cacheTime, function () use ($investor) {
            return Investor::find($investor->investor_reference_id);
        });

        $events = Cache::remember("events_{$id}", $cacheTime, function () use ($transfers, $creditNotes) {
            $events = collect();

            foreach ($transfers as $transfer) {
                $events->push((object) [
                    'date' => $transfer->transfer_date,
                    'type' => 'transfer',
                    'amount' => $transfer->transfer_amount,
                    'description' => $transfer->transfer_description,
                    'bank' => $transfer->transfer_bank,
                    'original_model' => $transfer
                ]);
            }

            foreach ($creditNotes as $creditNote) {
                $events->push((object) [
                    'date' => $creditNote->creditNote_date,
                    'type' => 'creditNote',
                    'amount' => -$creditNote->creditNote_amount,
                    'description' => $creditNote->creditNote_description,
                    'bank' => null,
                    'original_model' => $creditNote
                ]);
            }

            return $events->sortBy('date');
        });

        $currentBalance = 0;
        foreach ($events as $event) {
            $currentBalance += $event->amount;
            $event->current_balance = $currentBalance;
        }

        $transfers = $events->where('type', 'transfer')->map(function ($event) {
            $transfer = $event->original_model;
            $transfer->current_balance = $event->current_balance;
            return $transfer;
        });

        $creditNotes = $events->where('type', 'creditNote')->map(function ($event) {
            $creditNote = $event->original_model;
            $creditNote->current_balance = $event->current_balance;
            return $creditNote;
        });

        $activeProjects = Cache::remember("active_projects_{$id}", $cacheTime, function () use ($id) {
            return DB::table('projects')
                ->join('project_investor', 'projects.id', '=', 'project_investor.project_id')
                ->where('project_investor.investor_id', $id)
                ->where('projects.project_status', 1)
                ->select('projects.project_name', 'projects.project_code', 'projects.project_investment', 'project_investor.investor_investment', 'project_investor.investor_profit', 'project_investor.investor_final_profit')
                ->get();
        });

        $completedProjects = Cache::remember("completed_projects_{$id}", $cacheTime, function () use ($id) {
            return DB::table('projects')
                ->join('project_investor', 'projects.id', '=', 'project_investor.project_id')
                ->where('project_investor.investor_id', $id)
                ->where('projects.project_status', 0)
                ->select('projects.project_name', 'projects.project_code', 'projects.project_investment', 'project_investor.investor_investment', 'project_investor.investor_final_profit', 'project_investor.investor_profit')
                ->get();
        });

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

        return view(
            'modules.investors.show',
            compact(
                'investor',
                'investorFunds',
                'transfers',
                'creditNotes',
                'referenceInvestor',
                'activeProjects',
                'completedProjects',
                'total_project_investment',
                'total_project_investment_terminated',
                'total_commissioner_commission_payment',
                'total_investor_profit_payment',
                'total_investor_profit_paid',
                'total_commissioner_commission_paid',
                'loadTime'
            )
        );
    }

    public function edit($id)
    {
        $investor = Investor::findOrFail($id);
        return view('modules.investors.index', compact('investor'));
    }

    public function fund(StoreInverstorFundsRequest $request, $id)
    {
        // Encuentra el inversionista o falla si no existe
        $investor = Investor::findOrFail($id);
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        // Guarda los fondos anteriores antes de actualizar
        $oldFunds = $investor->investor_balance;

        // Actualiza el balance del inversionista
        $investor->investor_balance = $request->input('investor_new_funds');
        $investor->investor_status = '1';
        $investor->save();

        // Obtén los datos validados y añade los campos necesarios para InvestorFunds
        $validatedData = $request->validated();
        $validatedData[ 'investor_id' ] = $investor->id;
        $validatedData[ 'investor_change_date' ] = $todayDate;
        $validatedData[ 'investor_old_funds' ] = $oldFunds;
        $validatedData[ 'investor_new_funds' ] = $investor->investor_balance;
        $validatedData[ 'investor_new_funds_comment' ] = $request->input('investor_new_funds_comment');

        // Crea el registro en InvestorFunds usando create
        InvestorFunds::create($validatedData);

        // Redirige con un mensaje de éxito
        return redirect()->route('investor.index')->with("success", "Fondo del inversionista actualizado exitosamente.");
    }

    public function liquidate(StoreInvestorLiquidationsRequest $request, $id)
    {
        $investor = Investor::findOrFail($id);
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        $generatedCode = strtoupper(Str::random(12));
        $oldFunds = $investor->investor_balance;

        $validatedData = $request->validated();
        $validatedData[ 'investor_id' ] = $investor->id;
        $validatedData[ 'investor_liquidation_amount' ] = $investor->investor_balance;
        $validatedData[ 'investor_liquidation_date' ] = $todayDate;
        $validatedData[ 'liquidation_code' ] = $generatedCode;
        $validatedData[ 'liquidation_payment_mode' ] = $request->input('liquidation_payment_mode');
        $validatedData[ 'liquidation_payment_amount' ] = $request->input('liquidation_payment_amount');
        $validatedData[ 'liquidation_payment_comment' ] = $request->input('liquidation_payment_comment');

        // Procesar y guardar las imágenes
        $images = $request->file('liquidation_payment_imgs');
        if ($images) {
            $imageNames = [];
            foreach ($images as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/liquidations'), $imageName);
                $imageNames[] = $imageName;
            }
            $validatedData[ 'liquidation_payment_imgs' ] = json_encode($imageNames);
        }

        InvestorLiquidations::create($validatedData);

        // Obtén los datos validados y añade los campos necesarios para InvestorFunds
        $validatedData = $request->validated();
        $validatedData[ 'investor_id' ] = $investor->id;
        $validatedData[ 'investor_change_date' ] = $todayDate;
        $validatedData[ 'investor_old_funds' ] = $oldFunds;
        $validatedData[ 'investor_new_funds' ] = 0.00;
        $validatedData[ 'investor_new_funds_comment' ] = 'LIQUIDACIÓN AL INVERSIONISTA.';

        // Crea el registro en InvestorFunds usando create
        InvestorFunds::create($validatedData);

        // Actualizar el estado del inversionista y su fondo en 0.00
        $investor->investor_status = '3';
        $investor->investor_balance = '0.00';
        $investor->save();

        // session()->flash('investor_liquidation', $investor->id);

        return redirect()->route("investor.index")->with('success', 'Inversionista liquidado exitosamente.');
    }

    public function downloadLiquidation($id)
    {
        $investorLiquidation = InvestorLiquidations::findOrFail($id);
        $investorId = $investorLiquidation->investor_id;
        $investor = Investor::findOrFail($investorId);

        $generatedCode = strtoupper(Str::random(12)); // Random code
        $balanceToLiquidate = $investor->liquidation_payment_amount;

        // Configurar el locale en Carbon
        Carbon::setLocale('es');

        // Obtener la fecha actual en español
        $fecha = Carbon::now()->setTimezone('America/Costa_Rica');
        $day = $fecha->format('d');
        $month = $fecha->format('m');
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
        $pdf->loadHtml(view('modules.investors_liquidations._report_liquidation', compact('generatedCode', 'investorLiquidation', 'investor', 'day', 'month', 'year', 'balanceToLiquidate')));

        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $pdf->render();

        // Devolver el PDF para descarga forzada
        return response()->streamDownload(function () use ($pdf, $investor) {
            echo $pdf->output();
        }, $investor->investor_name . ' - LIQUIDACIÓN' . '.pdf');
    }

    public function update(UpdateRequest $request, Investor $investor)
    {
        $investor->update($request->all());
        return redirect()->route("investor.index")->with("success", "Inversionista actualizado exitosamente.");
    }

    public function destroy($id)
    {
        $investor = Investor::findOrFail($id);
        $investor->delete();

        return redirect()->route('investor.index')->with('success', 'Inversionista eliminado exitosamente.');
    }
}
