<?php

namespace Http\TeamController;

use App\Models\Team;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesTeam;

class TeamControllerTest extends HttpTest
{
    use CreatesTeam;

    const URL = '/v1/teams/%s';

    /**
     * @var Team
     */
    protected $team;

    /**
     * Runs before each test
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->team = $this->createTeam();
    }

    /**
     * Runs after each test
     *
     * @throws Exception
     */
    protected function tearDown(): void
    {
        $this->deleteTeams();
        parent::tearDown();
    }
}
