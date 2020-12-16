<?php

namespace Http\GroupController;

use App\Models\Group;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesGroup;

abstract class GroupControllerTest extends HttpTest
{
    use CreatesGroup;

    const URL = '/v1/groups/%s';

    /**
     * @var Group
     */
    protected $group;

    /**
     * Runs before each test
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->group = $this->createGroup();
    }

    /**
     * Runs after each test
     *
     * @throws Exception
     */
    protected function tearDown(): void
    {
        $this->deleteGroups();
        parent::tearDown();
    }
}
