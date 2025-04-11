<?php

declare(strict_types=1);

namespace App\Modules\MVP\Domain\Models;

use Illuminate\Support\Carbon;

/**
 * Class SearchRecipe
 *
 * @property string $id
 * @property string $name
 * @property string $keywords
 * @property float $minPrice
 * @property float $maxPrice
 * @property string|null $sortBy
 * @property string|null $category
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 */

class SearchRecipe
{
    public function __construct(
        public string  $id,
        public string  $name,
        public string        $keywords,
        public float         $minPrice,
        public float         $maxPrice,
        public ?string  $sortBy,
        public ?string  $category,
        public ?Carbon $createdAt = null,
        public ?Carbon $updatedAt = null,
    ) {
    }
}
