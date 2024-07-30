<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\DB;

class CommissionsSheet implements FromView, WithEvents, WithTitle
{
    public function view(): View
    {

        $investorCommissions = DB::table('project_investor')
        ->join('projects', 'project_investor.project_id', '=', 'projects.id')
        ->join('investors', 'project_investor.investor_id', '=', 'investors.id')
        ->where('projects.project_status', 1)
        ->select(
            'project_investor.*', // Todos los campos de project_investor
            'projects.project_name', // Nombre del proyecto
            'projects.project_code', // Código del proyecto
            'investors.investor_name' // Nombre del inversor
        )
        ->get();

        $totalInvestorCommissions = DB::table('project_investor')
            ->get()
            ->sum('investor_final_profit');
        
        $totalInvestorInvestment = DB::table('project_investor')
            ->get()
            ->sum('investor_investment');

        $commissionerCommissions = DB::table('project_commissioner')
            ->join('projects', 'project_commissioner.project_id', '=', 'projects.id')
            ->join('commission_agents', 'project_commissioner.commissioner_id', '=', 'commission_agents.id')
            ->where('projects.project_status', 1) // Solo proyectos activos
            ->select(
                'project_commissioner.*', // Todos los campos de project_commissioner
                'projects.project_name', // Nombre del proyecto
                'projects.project_code', // Código del proyecto
                'commission_agents.commissioner_name' // Nombre del comisionista
            )
            ->get();
    
        $totalCommissionerCommissions = DB::table('project_commissioner')
            ->get()
            ->sum('commissioner_commission');
        
        return view('modules.dashboard._commissions_report', [
            'investorCommissions' => $investorCommissions,
            'totalInvestorCommissions' => $totalInvestorCommissions,
            'totalInvestorInvestment' => $totalInvestorInvestment,
            'commissionerCommissions' => $commissionerCommissions,
            'totalCommissionerCommissions' => $totalCommissionerCommissions,
        ]);
    }

    public function title(): string
    {
        return 'COMISIONES'; // Nombre de la hoja
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $startRow = 4; // Inicio de la fila a partir de la cual se realizará el merge
                $headerStartRow = 2;
                $endRow = $sheet->getHighestRow();

                while ($startRow <= $endRow) {
                    $sheet->mergeCells('B' . $headerStartRow . ':G' . $headerStartRow);
                    $sheet->mergeCells('I' . $headerStartRow . ':N' . $headerStartRow);
                    $sheet->mergeCells('B' . $startRow . ':C' . $startRow);
                    $sheet->mergeCells('D' . $startRow . ':E' . $startRow);
                    $startRow++; // Incrementar startRow para evitar bucle infinito
                }

                // Buscar la fila que contiene el texto específico
                for ($row = 1; $row <= $endRow; $row++) {
                    $cellValue = $sheet->getCell('B' . $row)->getValue();
                    if ($cellValue === 'COMISIONES A FAVOR DE COMISIONISTAS') {
                        // Realizar el merge de B a F en la fila encontrada
                        $sheet->mergeCells('B' . $row . ':F' . $row);
                        $sheet->getStyle('B' . $row . ':F' . $row)->applyFromArray([
                            'font' => [
                                'bold' => true,
                                'size' => 16,
                            ],
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            ],
                            /*
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'startColor' => ['argb' => 'FFFFFF00'], // Color de fondo (ejemplo)
                            ], */
                        ]);
                        break; // Salir del bucle una vez encontrado
                    }
                }
            },
        ];
    }
}
