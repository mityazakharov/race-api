<?php

namespace Traits\Creates;

use App\Models\User;

trait CreatesUser
{
    /**
     * @var array
     */
    public $userIds = [];

    /**
     * @return User
     */
    public function createUser(): User
    {
        $user = User::factory()->create();
        $this->userIds[] = $user->id;

        return $user;
    }

    public function deleteUsers(): void
    {
        User::query()->whereIn('id', $this->userIds)->delete();
    }
}
