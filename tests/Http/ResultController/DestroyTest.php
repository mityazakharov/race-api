<?php

namespace Http\ResultController;

use Illuminate\Http\Response;

class DestroyTest extends ResultControllerTest
{
    public function testDestroy(): void
    {
        $this->json('DELETE', $this->buildUrl($this->athlete->id), [], $this->getAuthHeaders())
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
