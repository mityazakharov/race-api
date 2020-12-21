<?php

namespace Traits\Creates;

use App\Models\Race;

trait CreatesRace
{
    /**
     * @var array
     */
    public $raceIds = [];

    /**
     * @return Race
     */
    public function createRace(): Race
    {
        $race = Race::factory()->create();
        $this->raceIds[] = $race->id;

        return $race;
    }

    public function deleteRaces(): void
    {
        Race::query()->whereIn('id', $this->raceIds)->forceDelete();
    }
}
