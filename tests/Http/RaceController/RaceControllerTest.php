<?php

namespace Http\RaceController;

use App\Models\Discipline;
use App\Models\Race;
use App\Models\Season;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesDiscipline;
use Traits\Creates\CreatesRace;
use Traits\Creates\CreatesSeason;

abstract class RaceControllerTest extends HttpTest
{
    use CreatesRace, CreatesSeason, CreatesDiscipline;

    const URL = '/races/%s';

    /**
     * @var Discipline
     */
    protected $discipline;

    /**
     * @var Season
     */
    protected $season;

    /**
     * @var Race
     */
    protected $race;

    /**
     * Runs before each test
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->discipline = $this->createDiscipline();
        $this->season = $this->createSeason();
        $this->race = $this->createRace();
    }

    /**
     * Runs after each test
     *
     * @throws Exception
     */
    protected function tearDown(): void
    {
        $this->deleteRaces();
        $this->deleteSeasons();
        $this->deleteDisciplines();
        parent::tearDown();
    }
}
