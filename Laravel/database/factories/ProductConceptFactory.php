<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductConcept;
use App\Models\User;

class ProductConceptFactory extends Factory
{
    protected $model = ProductConcept::class;

    public function definition(): array
    {
        return [
            'uuid'                       => $this->faker->uuid(),
            'product_concept_stats_id'   => ProductConceptStat::factory(),
            'user_id'                    => User::factory(),
            'category_id'                => Category::factory(),
            'name'                       => $this->faker->name(),
            'description'                => $this->faker->text(),
            'concept_reviews_conclusion' => $this->faker->text(),
            'manual_review_flag'         => $this->faker->boolean(),
        ];
    }
}
