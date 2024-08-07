<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GeneralExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new ProjectsSheet(),
            new TransfersSheet(),
            new CommissionsSheet(),
            new PromissoryNotesSheet(),
            new InvestorsSheet(),
            new CommissionAgentsSheet(),
        ];
    }

    public function properties(): array
    {
        return [
            'title' => 'REPORTE GENERAL',
            'creator' => 'Investor Insight',
        ];
    }
}