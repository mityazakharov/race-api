<?php

namespace Database\Factories;

use App\Models\Discipline;
use App\Models\Race;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Race::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $seasons = Season::all()->pluck('id')->toArray();
        $disciplines = Discipline::all()->pluck('id')->toArray();

        return [
            'title'         => $this->faker->sentence(3),
            'date_at'       => $this->faker->date(),
            'season_id'     => $this->faker->randomElement($seasons),
            'stage'         => $this->faker->numberBetween(1, 3),
            'discipline_id' => $this->faker->randomElement($disciplines),
            'is_final'      => $this->faker->boolean(),
        ];
    }
}
