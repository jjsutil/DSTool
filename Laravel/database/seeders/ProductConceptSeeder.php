<?php

namespace Database\Seeders;

use App\Models\ProductConcept;
use Illuminate\Database\Seeder;

class ProductConceptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductConcept::factory()->count(5)->create();
    }
}
