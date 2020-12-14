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

    /**
     * @return array
     */
    public function registerUser(): array
    {
        /** @var User $user */
        $user = User::factory()->withPassword()->make();

        $password = $user->getAttribute('password');
        $user->setAttribute('password', app('hash')->make($password));
        $user->save();

        $this->userIds[] = $user->id;

        return [$user, $password];
    }

    public function deleteUsers(): void
    {
        User::query()->whereIn('id', $this->userIds)->delete();
    }
}
