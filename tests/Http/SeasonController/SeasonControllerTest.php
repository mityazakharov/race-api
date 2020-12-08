<?php

namespace Http\SeasonController;

use App\Models\Season;
use Http\HttpTest;
use Traits\Creates\CreatesSeason;

class SeasonControllerTest extends HttpTest
{
    use CreatesSeason;

    const URL = '/v1/seasons/%s';

    /**
     * @var Season
     */
    protected $season;

    /**
     * Runs before each test
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->season = $this->createSeason();
    }

    /**
     * Runs after each test
     *
     * @throws \Exception
     */
    protected function tearDown(): void
    {
        $this->deleteSeasons();
        parent::tearDown();
    }
}
