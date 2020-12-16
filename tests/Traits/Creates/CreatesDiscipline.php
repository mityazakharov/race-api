<?php

namespace Traits\Creates;

use App\Models\Discipline;

trait CreatesDiscipline
{
    /**
     * @var array
     */
    public $disciplineIds = [];

    /**
     * @return Discipline
     */
    public function createDiscipline(): Discipline
    {
        $discipline = Discipline::factory()->create();
        $this->disciplineIds[] = $discipline->id;

        return $discipline;
    }

    public function deleteDisciplines(): void
    {
        Discipline::query()->whereIn('id', $this->disciplineIds)->forceDelete();
    }
}
