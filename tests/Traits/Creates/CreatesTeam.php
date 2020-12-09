<?php

namespace Traits\Creates;

use App\Models\Team;

trait CreatesTeam
{
    /**
     * @var array
     */
    public $teamIds = [];

    /**
     * @return Team
     */
    public function createTeam(): Team
    {
        $team = Team::factory()->create();
        $this->teamIds[] = $team->id;

        return $team;
    }

    public function deleteTeams(): void
    {
        Team::query()->whereIn('id', $this->teamIds)->forceDelete();
    }
}
