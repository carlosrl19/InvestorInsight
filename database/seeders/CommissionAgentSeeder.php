<?php

namespace Database\Seeders;

use App\Models\CommissionAgent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommissionAgentSeeder extends Seeder
{
    public function run(): void
    {
        CommissionAgent::create(
            [
                'commissioner_name' => 'JUNIOR AYALA',
                'commissioner_dni' => '0801199907469',
                'commissioner_phone' => '31559105',
            ]
        );
        CommissionAgent::create(
            [
                'commissioner_name' => 'MARCOS BARAHONA',
                'commissioner_dni' => '0801199301345',
                'commissioner_phone' => '88978899',
            ]
        );
        CommissionAgent::create(
            [
                'commissioner_name' => 'ADA FLORES',
                'commissioner_dni' => '0801199812345',
                'commissioner_phone' => '31234567',
            ]
        );
    }
}
