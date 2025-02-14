<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScrapedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'source_id',
        'product_concept_id',
        'provider_id',
        'name',
        'category_id',
        'sales_quantity',
        'price',
        'currency',
        'review_conclusion',
        'stars',
        'photo_path',
        'reviews_count',
        'stock_quantity',
        'shipping_date',
        'shipping_cost',
        'shipping_currency',
        'matching_confidence_score',
    ];

    protected $casts = [
        'id'                        => 'integer',
        'price'                     => 'float',
        'stars'                     => 'float',
        'photo_path'                => 'array',
        'shipping_date'             => 'date',
        'shipping_cost'             => 'float',
        'matching_confidence_score' => 'float',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function productConcept(): BelongsTo
    {
        return $this->belongsTo(ProductConcept::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
