<?php

namespace Http;

use TestCase;

abstract class HttpTest extends TestCase
{
    /**
     * @var int
     */
    const AUTH_USER_ID = 1;

    /**
     * @param ?string $id
     *
     * @return string
     */
    protected function buildUrl(?string $id = ''): string
    {
        return sprintf(static::URL, $id);
    }

    /**
     * @param ?int $userId
     *
     * @return array
     */
    public function getAuthHeaders(?int $userId = null): array
    {
        if (is_null($userId)) {
            $userId = self::AUTH_USER_ID;
        }

        return [
            'Authorization' => 'Bearer ' . $this->getUserToken($userId),
            'Accept'        => 'Application/json',
            'Content-Type'  => 'Application/json',
        ];
    }

    /**
     * @param int $userId
     *
     * @return string
     */
    protected function getUserToken(int $userId): string
    {
        return auth()->tokenById($userId);
    }
}
