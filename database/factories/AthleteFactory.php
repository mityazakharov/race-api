<?php

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class AthleteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Athlete::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $teams = Team::all()->pluck('id')->toArray();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'year' => $this->faker->numberBetween(config('api.birth_year_min'), config('api.birth_year_max')),
            'gender' => $this->faker->randomElement(array_keys(Athlete::gender())),
            'team_id' => $this->faker->randomElement($teams),
            'rate' => $this->faker->boolean() ? $this->faker->randomElement(Athlete::rates()) : null,
        ];
    }
}
