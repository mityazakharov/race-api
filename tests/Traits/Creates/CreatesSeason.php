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
     * @param ?string $title
     * @param ?int $yearMin
     * @param ?int $yearMax
     * @param ?bool $isOddGroup
     *
     * @return Season
     */
    public function createSeason(
        ?string $title = '2010-2011',
        ?int $yearMin = 2010,
        ?int $yearMax = 2011,
        ?bool $isOddGroup = false
    ): Season
    {
        $season = Season::create([
            'title'        => $title,
            'year_min'     => $yearMin,
            'year_max'     => $yearMax,
            'is_odd_group' => $isOddGroup,
        ]);

        $this->seasonIds[] = $season->id;

        return $season;
    }

    public function deleteSeasons(): void
    {
        Season::query()->whereIn('id', $this->seasonIds)->forceDelete();
    }
}
