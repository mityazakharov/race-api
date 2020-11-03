<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthorizationException extends ApiException
{
    protected $statusCode = Response::HTTP_UNAUTHORIZED;

    protected $headers = [];

    protected $message = 'Unauthorized request';
}
