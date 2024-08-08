<?php

namespace Database\Seeders;

use App\Models\Investor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestorSeeder extends Seeder
{
    public function run(): void
    {
        Investor::create(
            [
                'investor_name'=>'PIVOTE',
                'investor_company_name'=>'ROBENIOR',
                'investor_dni'=>'0801199503998',
                'investor_phone'=>'88997787',
                'investor_reference_id'=>'2',
                'investor_balance'=>'0.00',
                'investor_status'=>'1',
            ]
        );
    }
}

