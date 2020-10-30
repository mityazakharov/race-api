<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // TODO: Render other error types to json
/*
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'result' => 'not found',
            ], 404, [], JSON_PRETTY_PRINT);
        }

        if ($request->wantsJson())
        {
            // Define the response
            $response = [
                'errors' => 'Sorry, something went wrong.'
            ];

            // If the app is in debug mode
            if (config('app.debug'))
            {
                // Add the exception class name, message and stack trace to response
                $response['exception'] = get_class($exception); // Reflection might be better here
//                $response['message'] = $exception->getMessage();
                $response['trace'] = $exception->getTrace();
            }

            // Default response of 400
            $status = 400;

            // If this exception is an instance of HttpException
            if ($exception instanceof HttpException)
            {
                // Grab the HTTP status code from the Exception
                $status = $exception->getStatusCode();
            }

            // Return a JSON response with the response array and status code
            return response()->json($response, $status);
        }
*/
        return parent::render($request, $exception);
    }
}
