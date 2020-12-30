<?php

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\Group;
use App\Models\Race;
use App\Models\Result;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Result::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $races = Race::all()->pluck('id')->toArray();
        $athletes = Athlete::all()->pluck('id')->toArray();
        $teams = Team::all()->pluck('id')->toArray();
        $groups = Group::all()->pluck('id')->toArray();

        return [
            'race_id' => $this->faker->randomElement($races),
            'athlete_id' => $this->faker->randomElement($athletes),
            'team_id' => $this->faker->randomElement($teams),
            'rate' => $this->faker->boolean() ? $this->faker->randomElement(Athlete::rates()) : null,
            'group_id' => $this->faker->randomElement($groups),
            'bib' => $this->faker->numberBetween(1, 300),
            'run_1' => $this->faker->numberBetween(2000, 20000),
            'status_1' => $this->faker->randomElement(Result::statuses()),
            'run_2' => $this->faker->numberBetween(2000, 20000),
            'status_2' => $this->faker->randomElement(Result::statuses()),
            'total' => $this->faker->numberBetween(4000, 40000),
            'diff' => $this->faker->numberBetween(0, 10000),
            'place' => $this->faker->boolean() ? $this->faker->numberBetween(1, 300) : null,
        ];
    }
}
