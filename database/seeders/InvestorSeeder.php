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
                'investor_dni'=>'0801199903999',
                'investor_phone'=>'88997788',
                'investor_reference_id'=>'4',
                'investor_balance'=>'678456',
                'investor_status'=>'1',
            ]
            );
            Investor::create(
            [
                'investor_name'=>'María Rodríguez',
                'investor_dni'=>'0801199903998',
                'investor_phone'=>'88997787',
                'investor_reference_id'=>'3',
                'investor_balance'=>'789012',
                'investor_status'=>'1',
            ]
            );
            Investor::create(
            [
                'investor_name'=>'Juan Gómez',
                'investor_dni'=>'0801199903997',
                'investor_phone'=>'88997786',
                'investor_reference_id'=>'2',
                'investor_balance'=>'567890',
                'investor_status'=>'1',
            ]
            );
            Investor::create(
            [
                'investor_name'=>'Ana Flores',
                'investor_dni'=>'0801199903996',
                'investor_phone'=>'88997785',
                'investor_reference_id'=>'1',
                'investor_balance'=>'456789',
                'investor_status'=>'1',
            ]
            );
            Investor::create(
            [
                'investor_name'=>'Pedro Martínez',
                'investor_dni'=>'0801199903995',
                'investor_phone'=>'88997784',
                'investor_reference_id'=>'5',
                'investor_balance'=>'789456',
                'investor_status'=>'1',
            ]
            );
    }
}

