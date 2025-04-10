<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Review
 *
 * @property int $id
 * @property string $uuid
 * @property int $scraped_product_id
 * @property int $user_id
 * @property string $reviewer_name
 * @property string $content
 * @property array<string> $photo_path
 * @property float $stars
 * @property int $helpful_votes
 */

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'scraped_product_id',
        'user_id',
        'reviewer_name',
        'content',
        'photo_path',
        'stars',
        'helpful_votes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id'         => 'integer',
        'photo_path' => 'array',
        'stars'      => 'float',
    ];

    public function scrapedProduct(): BelongsTo
    {
        return $this->belongsTo(ScrapedProduct::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
