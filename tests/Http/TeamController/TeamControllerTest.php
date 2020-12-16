<?php

namespace Http\TeamController;

use App\Models\Team;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesTeam;

abstract class TeamControllerTest extends HttpTest
{
    use CreatesTeam;

    const URL = '/teams/%s';

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
