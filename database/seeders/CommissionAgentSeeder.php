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
                'commissioner_code' => '00000001',
                'commissioner_name' => 'JUNIOR AYALA',
                'commissioner_dni' => '0801199907469',
                'commissioner_phone' => '31559105',
                'commissioner_balance' => '0.00',
            ]
        );
    }
}
