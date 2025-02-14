<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductConcept extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'product_concept_stats_id',
        'user_id',
        'category_id',
        'name',
        'description',
        'concept_reviews_conclusion',
        'manual_review_flag',
    ];

    protected $casts = [
        'id'                 => 'integer',
        'manual_review_flag' => 'boolean',
    ];

    public function productConceptStats(): BelongsTo
    {
        return $this->belongsTo(ProductConceptStats::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
