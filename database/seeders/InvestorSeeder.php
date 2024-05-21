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
                'investor_name'=>'Alejandro Hernández',
                'investor_company_name'=>'JAGUER',
                'investor_dni'=>'0801199903999',
                'investor_phone'=>'88997788',
                'investor_reference_id'=>'3',
                'investor_balance'=>'678456',
                'investor_status'=>'1',
            ]
        );

        Investor::create(
            [
                'investor_name'=>'María Rodríguez',
                'investor_company_name'=>'Future Capital',
                'investor_dni'=>'0801199503998',
                'investor_phone'=>'88997787',
                'investor_reference_id'=>'1',
                'investor_balance'=>'789012',
                'investor_status'=>'1',
            ]
        );
        
        Investor::create(
            [
                'investor_name'=>'Rodolfo Maradiaga',
                'investor_company_name'=>'Marsella',
                'investor_dni'=>'0801196903998',
                'investor_phone'=>'88997787',
                'investor_reference_id'=>'2',
                'investor_balance'=>'789012',
                'investor_status'=>'1',
            ]
        );
    }
}

