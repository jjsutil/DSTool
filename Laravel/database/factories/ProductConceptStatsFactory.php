<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductConcept;
use App\Models\ProductConceptStats;

class ProductConceptStatsFactory extends Factory
{
    protected $model = ProductConceptStats::class;

    public function definition(): array
    {
        return [
            'uuid'                => $this->faker->uuid(),
            'product_concept_id'  => ProductConcept::factory(),
            'average_sales'       => $this->faker->randomFloat(0, 0, 9999999999.),
            'stdev_sales'         => $this->faker->randomFloat(0, 0, 9999999999.),
            'publications_number' => $this->faker->numberBetween(-10000, 10000),
            'ali_to_meli_rate'    => $this->faker->randomFloat(0, 0, 9999999999.),
            'growth_rate'         => $this->faker->randomFloat(0, 0, 9999999999.),
            'price_trend'         => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
