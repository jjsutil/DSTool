<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Provider;
use App\Models\Source;

class ProviderFactory extends Factory
{
    protected $model = Provider::class;

    public function definition(): array
    {
        return [
            'uuid'      => $this->faker->uuid(),
            'source_id' => Source::factory(),
            'name'      => $this->faker->name(),
        ];
    }
}
