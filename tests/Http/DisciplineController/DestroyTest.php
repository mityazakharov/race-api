<?php

namespace Http\DisciplineController;

use Illuminate\Http\Response;

class DestroyTest extends DisciplineControllerTest
{
    public function testDestroy(): void
    {
        $this->json('DELETE', $this->buildUrl($this->discipline->id), [], $this->getAuthHeaders())
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
