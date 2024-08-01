<?php

namespace App\Http\Controllers;

use App\Http\Requests\Moneylender\StoreRequest;
use App\Http\Requests\Moneylender\UpdateRequest;

use App\Models\Moneylender;
use App\Models\Project;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MoneylenderController extends Controller
{
    public function index()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);
    
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        // Obtener los moneylenders
        $moneylenders = Cache::remember('moneylenders_list', $cacheTime, function () {
            return Moneylender::get();
        });
    
        // Obtener el total de inversión de proyectos activos
        $total_project_investment = Cache::remember('total_project_investment', $cacheTime, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });
    
        // Obtener el total de inversión de proyectos terminados
        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', $cacheTime, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });
    
        // Obtener el total de pago de comisiones a comisionistas
        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });
    
        // Obtener el total de pagos a inversores
        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', $cacheTime, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });
    
        // Obtener el total de ganancias pagadas a inversores
        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', $cacheTime, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });
    
        // Obtener el total de comisiones pagadas a comisionistas
        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });
    
        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;
    
        // Retornar la vista con los datos
        return view('modules.moneylenders.index', compact(
            'moneylenders',
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
        //
    }

    public function store(StoreRequest $request)
    {
        Moneylender::create($request->all());
        return redirect()->route('moneylender.index')->with('success', 'Prestamista creado exitosamente.');
    }

    public function show($id)
    {
        // Iniciar el temporizador
        $startTime = microtime(true);
    
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        // Obtener el moneylender por ID
        $moneylender = Cache::remember("moneylender_{$id}", $cacheTime, function () use ($id) {
            return Moneylender::findOrFail($id);
        });
    
        // Obtener el total de inversión de proyectos terminados
        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', $cacheTime, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });
    
        // Obtener el total de inversión de proyectos activos
        $total_project_investment = Cache::remember('total_project_investment', $cacheTime, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });
    
        // Obtener el total de pagos a inversores
        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', $cacheTime, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });
    
        // Obtener el total de ganancias pagadas a inversores
        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', $cacheTime, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });
    
        // Obtener el total de comisiones pagadas a comisionistas
        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });
    
        // Obtener el total de pago de comisiones a comisionistas
        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });
    
        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;
    
        // Retornar la vista con los datos
        return view('modules.moneylenders.show', compact(
            'moneylender',
            'total_project_investment',
            'total_project_investment_terminated',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid',
            'total_commissioner_commission_payment',
            'loadTime'
        ));
    }

    public function edit(Moneylender $moneylender)
    {
        //
    }

    public function update(UpdateRequest $request, Moneylender $moneylender)
    {
        $moneylender->update($request->all());
        return redirect()->route("moneylender.index")->with("success", "Prestamista actualizado exitosamente.");
    }

    public function destroy($id)
    {
        $moneylender = Moneylender::findOrFail($id);
        $moneylender->delete();
    
        return redirect()->route('moneylender.index')->with('success', 'Prestamista eliminado exitosamente.');
    }
}
