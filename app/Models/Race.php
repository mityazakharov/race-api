<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Race extends Model
{
    use HasFactory;

    const RATE_YOUNG_3 = '3 юн';
    const RATE_YOUNG_2 = '2 юн';
    const RATE_YOUNG_1 = '1 юн';
    const RATE_ADULT_3 = 'III';
    const RATE_ADULT_2 = 'II';
    const RATE_ADULT_1 = 'I';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'date_at',
        'season_id',
        'stage',
        'discipline_id',
        'is_final'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'title'         => 'string',
        'date_at'       => 'date',
        'season_id'     => 'integer',
        'stage'         => 'integer',
        'discipline_id' => 'integer',
        'is_final'      => 'boolean',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

}
