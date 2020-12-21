<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Athlete extends Model
{
    use SoftDeletes, HasFactory;

    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'W';

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
        'first_name',
        'last_name',
        'year',
        'gender',
        'team_id',
        'rate',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name'  => 'string',
        'year'       => 'integer',
        'gender'     => 'string',
        'team_id'    => 'integer',
        'rate'       => 'string',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Return gender characters
     *
     * @return string[]
     */
    public static function gender(): array
    {
        return [
            self::GENDER_MALE   => 'М',
            self::GENDER_FEMALE => 'Ж',
        ];
    }

    /**
     * Return sport rate names
     *
     * @return string[]
     */
    public static function rates(): array
    {
        return [
            self::RATE_YOUNG_3,
            self::RATE_YOUNG_2,
            self::RATE_YOUNG_1,
            self::RATE_ADULT_3,
            self::RATE_ADULT_2,
            self::RATE_ADULT_1,
        ];
    }
}
