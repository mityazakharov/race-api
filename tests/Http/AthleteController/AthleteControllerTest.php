<?php

namespace Http\AthleteController;

use App\Models\Athlete;
use App\Models\Team;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesAthlete;
use Traits\Creates\CreatesTeam;

abstract class AthleteControllerTest extends HttpTest
{
    use CreatesAthlete, CreatesTeam;

    const URL = '/athletes/%s';

    /**
     * @var Team
     */
    protected $team;

    /**
     * @var Athlete
     */
    protected $athlete;

    /**
     * Runs before each test
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->team = $this->createTeam();
        $this->athlete = $this->createAthlete();
    }

    /**
     * Runs after each test
     *
     * @throws Exception
     */
    protected function tearDown(): void
    {
        $this->deleteAthletes();
        $this->deleteTeams();
        parent::tearDown();
    }
}
