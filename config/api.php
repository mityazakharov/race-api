<?php

// API config

return [
    /*
    |--------------------------------------------------------------------------
    | Date boundaries
    |--------------------------------------------------------------------------
    |
    */
    'birth_year_min'  => env('BIRTH_YEAR_MIN', 1990),
    'birth_year_max'  => env('BIRTH_YEAR_MAX', 2030),
    'season_year_min' => env('SEASON_YEAR_MIN', 2000),
    'season_year_max' => env('SEASON_YEAR_MAX', 2040),
];
