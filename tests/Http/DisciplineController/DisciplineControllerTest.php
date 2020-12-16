<?php

namespace Http\DisciplineController;

use App\Models\Discipline;
use Exception;
use Http\HttpTest;
use Traits\Creates\CreatesDiscipline;

abstract class DisciplineControllerTest extends HttpTest
{
    use CreatesDiscipline;

    const URL = '/disciplines/%s';

    /**
     * @var Discipline
     */
    protected $discipline;

    /**
     * Runs before each test
     *
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->discipline = $this->createDiscipline();
    }

    /**
     * Runs after each test
     *
     * @throws Exception
     */
    protected function tearDown(): void
    {
        $this->deleteDisciplines();
        parent::tearDown();
    }
}
