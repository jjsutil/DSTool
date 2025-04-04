<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductConcept;
use App\Models\ProductConceptReview;
use App\Models\User;

class ProductConceptReviewFactory extends Factory
{
    protected $model = ProductConceptReview::class;

    public function definition(): array
    {
        return [
            'uuid'               => $this->faker->uuid(),
            'user_id'            => User::factory(),
            'product_concept_id' => ProductConcept::factory(),
            'rating'             => $this->faker->numberBetween(-10000, 10000),
            'comment'            => $this->faker->text(),
        ];
    }
}
