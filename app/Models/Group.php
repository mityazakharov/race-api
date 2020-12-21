<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'year_min',
        'year_max',
        'gender',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'title'        => 'string',
        'year_min'     => 'integer',
        'year_max'     => 'integer',
        'gender'       => 'string',
    ];

    /**
     * Set is_odd flag
     *
     * @param int $value
     * @return void
     */
    public  function setYearMinAttribute(int $value): void
    {
        $this->attributes['year_min'] = $value;
        $this->attributes['is_odd'] = boolval($value % 2);
    }
}
