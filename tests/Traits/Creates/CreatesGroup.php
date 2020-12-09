<?php

namespace Traits\Creates;

use App\Models\Group;

trait CreatesGroup
{
    /**
     * @var array
     */
    public $groupIds = [];

    /**
     * @return Group
     */
    public function createGroup(): Group
    {
        $group = Group::factory()->create();
        $this->groupIds[] = $group->id;

        return $group;
    }

    public function deleteGroups(): void
    {
        Group::query()->whereIn('id', $this->groupIds)->forceDelete();
    }
}
