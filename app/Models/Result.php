<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    const STATUS_OK = 'OK';
    const STATUS_DNS = 'DNS';
    const STATUS_DNF = 'DNF';
    const STATUS_DSQ = 'DSQ';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'race_id',
        'athlete_id',
        'team_id',
        'rate',
        'group_id',
        'bib',
        'run_1',
        'status_1',
        'run_2',
        'status_2',
        'total',
        'diff',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'race_id'    => 'integer',
        'athlete_id' => 'integer',
        'team_id'    => 'integer',
        'rate'       => 'string',
        'group_id'   => 'integer',
        'bib'        => 'integer',
        'run_1'      => 'integer',
        'status_1'   => 'string',
        'run_2'      => 'integer',
        'status_2'   => 'string',
        'total'      => 'integer',
        'diff'       => 'integer',
        'place'      => 'integer',
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function athlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Return result status names
     *
     * @return string[]
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_OK,
            self::STATUS_DNS,
            self::STATUS_DNF,
            self::STATUS_DSQ,
        ];
    }
}
