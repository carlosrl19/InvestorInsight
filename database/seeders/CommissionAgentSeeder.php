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
                'commissioner_name'=>'Julio Martínez',
                'commissioner_dni'=>'1203198705991',
                'commissioner_phone'=>'37889900',
            ]
        );
        CommissionAgent::create(
            [
                'commissioner_name'=>'Luisa Gómez',
                'commissioner_dni'=>'1203198805992',
                'commissioner_phone'=>'87889901',
            ]
        );
        CommissionAgent::create(
            [
                'commissioner_name'=>'Carolina López',
                'commissioner_dni'=>'1203198905993',
                'commissioner_phone'=>'97889902',
            ]
        );
    }
}
