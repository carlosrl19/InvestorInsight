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
                'commissioner_balance' => '0.00',
            ]
        );

        CommissionAgent::create([
            'commissioner_name' => 'AA MARIA PEREZ',
            'commissioner_dni' => '0801198807123',
            'commissioner_phone' => '33445566',
            'commissioner_balance' => '0.00',
        ]);

        CommissionAgent::create([
            'commissioner_name' => 'AA JUAN GONZALEZ',
            'commissioner_dni' => '0801199012345',
            'commissioner_phone' => '44556677',
            'commissioner_balance' => '0.00',
        ]);

        CommissionAgent::create([
            'commissioner_name' => 'AA ANA MARTINEZ',
            'commissioner_dni' => '0801199987654',
            'commissioner_phone' => '55667788',
            'commissioner_balance' => '0.00',
        ]);

        CommissionAgent::create([
            'commissioner_name' => 'AA PEDRO DIAZ',
            'commissioner_dni' => '0801199911223',
            'commissioner_phone' => '66778899',
            'commissioner_balance' => '0.00',
        ]);
    }
}
