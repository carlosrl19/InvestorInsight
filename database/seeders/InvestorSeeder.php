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
                'investor_name'=>'First investor helper',
                'investor_dni'=>'080119990399',
                'investor_phone'=>'88997788',
                'investor_reference_id'=>'1',
                'investor_balance'=>'0',
                'investor_status'=>'1',
            ]
        );
    }
}
