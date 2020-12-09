<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Season::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $year_min = $this->faker->numberBetween(config('api.season_year_min'), config('api.season_year_max') - 1);
        $year_max = $year_min + 1;

        return [
            'title'        => "{$year_min}-{$year_max}",
            'year_min'     => $year_min,
            'year_max'     => $year_max,
            'is_odd_group' => boolval($year_min % 2),
        ];
    }
}
