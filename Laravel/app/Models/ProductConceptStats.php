<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductConceptStats extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'product_concept_id',
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
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
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
