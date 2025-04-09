<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class ProductConceptStatsHistory
 *
 * @property int $id
 * @property string $uuid
 * @property int $product_concept_id
 * @property float $average_sales
 * @property float $stdev_sales
 * @property int $publications_number
 * @property float $ali_to_meli_rate
 * @property float $growth_rate
 * @property float $price_trend
 * @property Carbon $timestamp
 *
 */
class ProductConceptStatsHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'product_concept_id',
        'timestamp',
        'average_sales',
        'stdev_sales',
        'publications_number',
        'ali_to_meli_rate',
        'growth_rate',
        'price_trend',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id'               => 'integer',
        'timestamp'        => 'timestamp',
        'average_sales'    => 'float',
        'stdev_sales'      => 'float',
        'ali_to_meli_rate' => 'float',
        'growth_rate'      => 'float',
        'price_trend'      => 'float',
    ];

    public function productConcept(): BelongsTo
    {
        return $this->belongsTo(ProductConcept::class);
    }
}
