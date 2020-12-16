<?php

namespace Http\UserController;

use App\Models\User;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesUser;

abstract class UserControllerTest extends HttpTest
{
    use CreatesUser;

    const URL = '/v1/users/%s';

    /**
     * @var User
     */
    protected $user;

    /**
     * Runs before each test
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }

    /**
     * Runs after each test
     *
     * @throws Exception
     */
    protected function tearDown(): void
    {
        $this->deleteUsers();
        parent::tearDown();
    }
}
