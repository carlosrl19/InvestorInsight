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
                'commissioner_name'=>'Junior Alexis Ayala Guerrero',
                'commissioner_dni'=>'0801199907469',
                'commissioner_phone'=>'31559105',
            ]
        );
        CommissionAgent::create(
            [
                'commissioner_name'=>'Marcos Alonso Barahona Ramos',
                'commissioner_dni'=>'0801199301345',
                'commissioner_phone'=>'88978899',
            ]
        );
        CommissionAgent::create(
            [
            'commissioner_name' => 'Juana María Sánchez Flores',
            'commissioner_dni' => '0801199812345',
            'commissioner_phone' => '31234567',
            ]
        );
        CommissionAgent::create(
            [
                'commissioner_name' => 'Pedro Ramírez Gómez',
                'commissioner_dni' => '0703201012345',
                'commissioner_phone' => '88987654',
            ]
        );
        CommissionAgent::create(
            [
                'commissioner_name' => 'María Fernanda Hernández Torres',
                'commissioner_dni' => '0801201912345',
                'commissioner_phone' => '94567890',
            ]
        );
    }
}
