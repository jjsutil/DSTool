<?php

declare(strict_types=1);

namespace App\Modules\MVP\Infrastructure\Services\Mappers;

use App\Modules\MVP\Domain\Models\SearchRecipe as SearchRecipeFromDomain;
use App\Models\SearchRecipe as SearchRecipeFromEloquent;

class SearchRecipeMapper
{
    public static function fromEloquentToDomain(SearchRecipeFromEloquent $model): SearchRecipeFromDomain
    {
        return new SearchRecipeFromDomain(
            uuid: $model->id,
            name: $model->name,
            keywords: $model->keywords,
            minPrice: (float) $model->min_price,
            maxPrice: (float) $model->max_price,
            sortBy: $model->sort_by,
            category: $model->category,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at,
        );
    }

    public static function fromDomainToEloquent(SearchRecipeFromDomain $domain): SearchRecipeFromEloquent
    {
        $model = new SearchRecipeFromEloquent();

        $model->id        = $domain->uuid;
        $model->name      = $domain->name;
        $model->keywords  = $domain->keywords;
        $model->min_price = $domain->minPrice;
        $model->max_price = $domain->maxPrice;
        $model->sort_by   = $domain->sortBy;
        $model->category  = $domain->category;

        $model->created_at = $domain->createdAt;
        $model->updated_at = $domain->updatedAt;

        return $model;
    }

    public static function fromDomainToArray(SearchRecipeFromDomain $domain): array
    {
        return [
            'uuid'         => $domain->uuid,
            'name'       => $domain->name,
            'min_price'  => $domain->minPrice,
            'max_price'  => $domain->maxPrice,
            'keywords'   => $domain->keywords,
            'sort_by'    => $domain->sortBy,
            'category'   => $domain->category,
            'created_at' => $domain->createdAt,
            'updated_at' => $domain->updatedAt,
        ];
    }

    public static function fromDomainToJson(SearchRecipeFromDomain $domain): string
    {
        return json_encode(self::fromDomainToArray($domain));
    }
}
