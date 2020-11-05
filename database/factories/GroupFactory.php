<?php

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $year_min = $this->faker->numberBetween(1990, 2030);
        $year_max = $year_min + 1;
        $gender = $this->faker->randomElement(array_keys(Athlete::gender()));

        return [
            'title'    => "{$gender} {$year_min}-{$year_max}",
            'year_min' => $year_min,
            'year_max' => $year_max,
            'gender'   => $gender,
            'is_odd'   => boolval($year_min % 2),
        ];
    }
}
