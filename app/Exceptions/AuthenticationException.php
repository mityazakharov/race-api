<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthenticationException extends ApiException
{
    protected $statusCode = Response::HTTP_UNAUTHORIZED;

    protected $headers = [];

    protected $message = 'Identification failed';
}
