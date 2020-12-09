<?php

namespace Traits\Creates;

use App\Models\Athlete;

trait CreatesAthlete
{
    /**
     * @var array
     */
    public $athleteIds = [];

    /**
     * @return Athlete
     */
    public function createAthlete(): Athlete
    {
        $athlete = Athlete::factory()->create();
        $this->athleteIds[] = $athlete->id;

        return $athlete;
    }

    public function deleteAthletes(): void
    {
        Athlete::query()->whereIn('id', $this->athleteIds)->forceDelete();
    }
}
