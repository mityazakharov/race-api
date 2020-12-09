<?php

namespace Http\AthleteController;

use Illuminate\Http\Response;

class DestroyTest extends AthleteControllerTest
{
    public function testDestroy(): void
    {
        $this->json('DELETE', $this->buildUrl($this->athlete->id), [], $this->getAuthHeaders())
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
