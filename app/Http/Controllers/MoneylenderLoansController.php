<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoneylenderLoans\StoreRequest;
use App\Http\Requests\MoneylenderLoans\UpdateRequest;

use App\Models\MoneylenderLoans;

use Illuminate\Support\Facades\Cache;

class MoneylenderLoansController extends Controller
{
    public function index()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);
    
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        // Obtener los préstamos de moneylenders, almacenando en caché
        $moneylenderLoans = Cache::remember('moneylender_loans_latest', $cacheTime, function () {
            return MoneylenderLoans::latest()->take(20)->get();
        });
    
        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;
    
        // Retornar la vista con los datos
        return view('modules.moneylender_loans.index', compact('moneylenderLoans', 'loadTime'));
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        //
    }

    public function show(MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function edit(MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function update(UpdateRequest $request, MoneylenderLoans $moneylenderLoans)
    {
        //
    }

    public function destroy(MoneylenderLoans $moneylenderLoans)
    {
        //
    }
}
