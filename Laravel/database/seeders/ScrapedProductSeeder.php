<?php

namespace Database\Seeders;

use App\Models\ScrapedProduct;
use Illuminate\Database\Seeder;

class ScrapedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScrapedProduct::factory()->count(5)->create();
    }
}
