<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductConcept;
use App\Models\Provider;
use App\Models\ScrapedProduct;
use App\Models\Source;

class ScrapedProductFactory extends Factory
{
    protected $model = ScrapedProduct::class;

    public function definition(): array
    {
        return [
            'uuid'                      => $this->faker->uuid(),
            'source_id'                 => Source::factory(),
            'product_concept_id'        => ProductConcept::factory(),
            'provider_id'               => Provider::factory(),
            'name'                      => $this->faker->name(),
            'sales_quantity'            => $this->faker->numberBetween(-10000, 10000),
            'price'                     => $this->faker->randomFloat(0, 0, 9999999999.),
            'currency'                  => $this->faker->word(),
            'review_conclusion'         => $this->faker->text(),
            'stars'                     => $this->faker->randomFloat(0, 0, 9999999999.),
            'photo_path'                => '{}',
            'reviews_count'             => $this->faker->numberBetween(-10000, 10000),
            'stock_quantity'            => $this->faker->numberBetween(-10000, 10000),
            'shipping_date'             => $this->faker->date(),
            'shipping_cost'             => $this->faker->randomFloat(0, 0, 9999999999.),
            'shipping_currency'         => $this->faker->word(),
            'matching_confidence_score' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
