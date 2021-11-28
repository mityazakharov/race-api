<?php

namespace Http\ResultController;

use App\Models\Athlete;
use App\Models\Group;
use App\Models\Race;
use App\Models\Result;
use App\Models\Team;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesAthlete;
use Traits\Creates\CreatesGroup;
use Traits\Creates\CreatesRace;
use Traits\Creates\CreatesResult;
use Traits\Creates\CreatesTeam;

abstract class ResultControllerTest extends HttpTest
{
    use CreatesResult, CreatesRace, CreatesAthlete, CreatesTeam, CreatesGroup;

    const URL = '/results/%s';

    /**
     * @var Race
     */
    protected $race;

    /**
     * @var Athlete
     */
    protected $athlete;

    /**
     * @var Team
     */
    protected $team;

    /**
     * @var Group
     */
    protected $group;

    /**
     * @var Result
     */
    protected $result;

    /**
     * Runs before each test
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->team = $this->createTeam();
        $this->group = $this->createGroup();
        $this->athlete = $this->createAthlete();
        $this->race = $this->createRace();
        $this->result = $this->createResultItem();
    }

    /**
     * Runs after each test
     *
     * @throws Exception
     */
    protected function tearDown(): void
    {
        $this->deleteResults();
        $this->deleteRaces();
        $this->deleteAthletes();
        $this->deleteGroups();
        $this->deleteTeams();
        parent::tearDown();
    }
}
