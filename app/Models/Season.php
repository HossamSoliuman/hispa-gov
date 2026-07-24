<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    /** @use HasFactory<\Database\Factories\SeasonFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'region',
        'start_date',
        'end_date',
        'fishing_tools',
        'licenses_count',
        'minimum_size',
        'maximum_size',
        'restrictions',
    ];

    protected $attributes = [
        'status' => 'upcoming',
        'licenses_count' => 0,
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'fishing_tools' => 'array',
            'licenses_count' => 'integer',
            'minimum_size' => 'decimal:2',
            'maximum_size' => 'decimal:2',
        ];
    }
}
