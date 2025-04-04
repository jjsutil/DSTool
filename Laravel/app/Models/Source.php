<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'source_origin',
        'url',
    ];

    protected $casts = [
        'id' => 'integer',
    ];
}
