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

        Investor::create(
            [
                'investor_name'=>'CARLOS RODRIGUEZ',
                'investor_company_name'=>'ROBENIOR',
                'investor_dni'=>'0703199903200',
                'investor_phone'=>'97992867',
                'investor_reference_id'=>'1',
                'investor_balance'=>'45000.00',
                'investor_status'=>'1',
            ]
        );
    }
}

