<?php


namespace App\Exceptions;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiException extends \Exception implements HttpExceptionInterface
{
    /**
     * HTTP response status code.
     *
     * @var int
     */
    protected $statusCode = Response::HTTP_BAD_REQUEST;

    /**
     * Response headers.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * The error message.
     *
     * @var string
     */
    protected $message = 'Internal API Error';

    /**
     * Returns the status code.
     *
     * @return int An HTTP response status code
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Returns response headers.
     *
     * @return array Response headers
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
