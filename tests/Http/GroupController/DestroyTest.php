<?php

namespace Http\GroupController;

use Illuminate\Http\Response;

class DestroyTest extends GroupControllerTest
{
    public function testDestroy(): void
    {
        $this->json('DELETE', $this->buildUrl($this->group->id), [], $this->getAuthHeaders())
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
