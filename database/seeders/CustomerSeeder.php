<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Benjie Lenteria',
                'email' => 'benjielenteria@yahoo.com',
                'phone' => '09171234567',
            ],
            [
                'name' => 'Lentrix Hawkman',
                'email' => 'hawkmanlentrix@gmail.com',
                'phone' => '09179876543',
            ],
            [
                'name' => 'Lentrix of MDC',
                'email' => 'lentrix@materdeicollege.com',
                'phone' => '09221234567',
            ],

        ];

        foreach ($customers as $customer) {
            DB::table('customers')->insert($customer);
        }
    }
}
