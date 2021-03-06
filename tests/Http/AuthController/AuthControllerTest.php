<?php

namespace Http\AuthController;

use App\Models\User;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesUser;

abstract class AuthControllerTest extends HttpTest
{
    use  CreatesUser;

    const URL = '/auth/%s';

    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $password;

    /**
     * Runs before each test
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        [$this->user, $this->password] = $this->registerUser();
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
