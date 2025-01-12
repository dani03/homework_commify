<?php

namespace Database\Seeders;

use App\Models\TaxRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TaxRate::factory()->create([
            'name' => 'tax band A',
            'percent' => 0,
            'range' => '5000',
            'identifier' => 'A',
            'annual_salary_range' => 5000,

        ]);
        TaxRate::factory()->create([
            'name' => 'tax band B',
            'percent' => 20,
            'range' => '5000 - 20000',
            'identifier' => 'B',
            'annual_salary_range' => 20000,

        ]);

        TaxRate::factory()->create([
            'name' => 'tax band C',
            'percent' => 40,
            'range' => '20000 +',
            'identifier' => 'C',
            'annual_salary_range' => 20000,
        ]);
    }
}
