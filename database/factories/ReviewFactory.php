<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Review;
use App\Models\ScrapedProduct;
use App\Models\User;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'uuid'               => $this->faker->uuid(),
            'scraped_product_id' => ScrapedProduct::factory(),
            'user_id'            => User::factory(),
            'reviewer_name'      => $this->faker->word(),
            'content'            => $this->faker->paragraphs(3, true),
            'photo_path'         => '{}',
            'stars'              => $this->faker->randomFloat(0, 0, 9999999999.),
            'helpful_votes'      => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
