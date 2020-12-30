<?php

namespace Traits\Creates;

use App\Models\Result;

trait CreatesResult
{
    /**
     * @var array
     */
    public $resultIds = [];

    /**
     * @return Result
     */
    public function createResultItem(): Result
    {
        $result = Result::factory()->create();
        $this->resultIds[] = $result->id;

        return $result;
    }

    public function deleteResults(): void
    {
        Result::query()->whereIn('id', $this->resultIds)->forceDelete();
    }
}
