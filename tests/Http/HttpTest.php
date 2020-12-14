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
     * @param int $userId
     *
     * @return array
     */
    public function getAuthHeaders(int $userId = self::AUTH_USER_ID): array
    {
        $headers = $this->getHeaders();
        $headers['Authorization'] = 'Bearer ' . $this->getUserToken($userId);

        return $headers;
    }

    public function getHeaders(): array
    {
        return [
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
