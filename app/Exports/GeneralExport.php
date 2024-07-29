<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GeneralExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new ProjectsSheet(),
            new CommissionsSheet(),
            new InvestorsSheet(),
            new CommissionAgentsSheet(),
            new TransfersSheet(),
            new PromissoryNotesSheet(),
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