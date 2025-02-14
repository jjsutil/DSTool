<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ProductConcept;
use App\Models\ProductConceptReview;
use App\Models\User;

class ProductConceptReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductConceptReview::class;

    /**
     * Define the model's default state.
     */
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
