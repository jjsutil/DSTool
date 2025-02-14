<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Source;

class SourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Source::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'uuid'          => $this->faker->uuid(),
            'source_origin' => $this->faker->word(),
            'url'           => $this->faker->url(),
        ];
    }
}
