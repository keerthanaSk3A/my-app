<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'price',
        'release_date',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
        'release_date' => 'date',
        'price' => 'decimal:2',
    ];
}
