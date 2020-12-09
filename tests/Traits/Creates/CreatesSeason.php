<?php

namespace Traits\Creates;

use App\Models\Season;

trait CreatesSeason
{
    /**
     * @var array
     */
    public $seasonIds = [];

    /**
     * @return Season
     */
    public function createSeason(): Season
    {
        $season = Season::factory()->create();
        $this->seasonIds[] = $season->id;

        return $season;
    }

    public function deleteSeasons(): void
    {
        Season::query()->whereIn('id', $this->seasonIds)->forceDelete();
    }
}
