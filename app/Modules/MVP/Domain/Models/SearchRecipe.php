<?php

declare(strict_types=1);

namespace App\Modules\MVP\Domain\Models;

use Illuminate\Support\Carbon;

/**
 * Class SearchRecipe
 *
 * @property string $id
 * @property string $name
 * @property array $keywords
 * @property float $min_price
 * @property float $max_price
 * @property string $sort_by
 * @property string $category
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

readonly class SearchRecipe
{
    public function __construct(
        public string  $id,
        public string  $name,
        public array   $keywords,
        public float   $minPrice,
        public float   $maxPrice,
        public string  $sortBy,
        public string  $category,
        public ?Carbon $createdAt = null,
        public ?Carbon $updatedAt = null,
    ) {
    }
}
