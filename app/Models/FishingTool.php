<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishingTool extends Model
{
    /** @use HasFactory<\Database\Factories\FishingToolFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $attributes = [
        'status' => 'active',
    ];
}
