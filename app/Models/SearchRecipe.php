<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
class SearchRecipe extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType   = 'string';

    protected $fillable = [
        'id',
        'name',
        'keywords',
        'min_price',
        'max_price',
        'sort_by',
        'category',
    ];

    protected $casts = [
        'id'        => 'string',
        'keywords'  => 'array',
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = Str::uuid()->toString();
            }
        });
    }


}
