<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Http\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @param ResponseFactory $factory
     * @return void
     */
    public function boot(ResponseFactory $factory): void
    {
        $factory->macro('jsonOptions', function () {
            return JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;
        });

        /**
         * Response JSON on success
         */
        $factory->macro('jsonSuccess', function ($rawData) use ($factory) {
            $data = [
                'result' => 'success',
                'data'   => $rawData,
            ];

            return $factory->json($data, Response::HTTP_OK, [], $this->jsonOptions());
        });

        /**
         * Response JSON on success (for newly created data)
         */
        $factory->macro('jsonSuccessNew', function ($rawData) use ($factory) {
            $data = [
                'result' => 'success',
                'data'   => $rawData,
            ];

            $headers = [
                'Location' => Request::url() . '/' . $rawData->id,
            ];

            return $factory->json($data, Response::HTTP_CREATED, $headers, $this->jsonOptions());
        });

        /**
         * Empty response JSON on success (ex. DELETE)
         */
        $factory->macro('jsonSuccessEmpty', function () use ($factory) {
            $data = [
                'result' => 'success',
            ];

            return $factory->json($data, Response::HTTP_OK, [], $this->jsonOptions());
        });

        /**
         * Make error type from exception class
         */
        $factory->macro('exceptionType', function (\Exception $exception) {
            try {
                $className = (new \ReflectionClass($exception))->getShortName();
                $type = Str::snake(str_replace('Exception', '', $className));
            } catch (\ReflectionException $exception) {
                $type = 'internal_api_error';
            }

            return $type;
        });


        $factory->macro('jsonException', function (\Exception $exception) {
            switch (true) {
                case $exception instanceof ModelNotFoundException:
                case $exception instanceof NotFoundHttpException:
                    return $this->jsonFailureNotFound($exception);

                case $exception instanceof QueryException:
                    return $this->jsonFailureQuery($exception);

                case $exception instanceof ValidationException:
                    return $this->jsonFailureValidation($exception);

                default:
                    return $this->jsonFailure($exception);
            }
        });

        /**
         * Exception JSON response
         */
        $factory->macro('jsonFailure', function (\Exception $exception) use ($factory) {
            $data = [
                'result' => 'failure',
                'error'  => [
                    'type'  => $this->exceptionType($exception),
                    'title' => $exception->getMessage(),
                ],
            ];

            $status = method_exists($exception, 'getStatusCode')
                ? $exception->getStatusCode()
                : Response::HTTP_INTERNAL_SERVER_ERROR;

            $headers = method_exists($exception, 'getHeaders')
                ? $exception->getHeaders()
                : [];

            return $factory->json($data, $status, $headers, $this->jsonOptions());
        });

        /**
         * Not found exception JSON response
         */
        $factory->macro('jsonFailureNotFound', function (\Exception $exception) use ($factory) {
            if ($exception instanceof ModelNotFoundException) {
                $message = str_replace('App\\Models\\', '', $exception->getMessage());
                $location = Str::beforeLast(Request::url(), '/');
            } else {
                $message = 'No API results for endpoint [' . Request::path() . ']';
                $location = Request::root();
            }

            $data = [
                'result' => 'failure',
                'error'  => [
                    'type'  => $this->exceptionType($exception),
                    'title' => $message,
                ],
            ];

            $status = Response::HTTP_NOT_FOUND;

            $headers = ['Location' => $location];

            return $factory->json($data, $status, $headers, $this->jsonOptions());
        });

        /**
         * SQL query exception JSON response
         */
        $factory->macro('jsonFailureQuery', function (QueryException $exception) use ($factory) {
            $message = Str::before(Str::after($exception->getMessage(), ': '), ':');

            $data = [
                'result' => 'failure',
                'error'  => [
                    'type'  => $this->exceptionType($exception),
                    'title' => $message,
                ],
            ];

            $status = Response::HTTP_BAD_REQUEST;

            $headers = [];

            return $factory->json($data, $status, $headers, $this->jsonOptions());
        });

        /**
         * Form validation exception JSON response
         */
        $factory->macro('jsonFailureValidation', function (ValidationException $exception) use ($factory) {
            $data = [
                'result' => 'failure',
                'error'  => [
                    'type'    => $this->exceptionType($exception),
                    'title'   => $exception->getMessage(),
                    'invalid' => $exception->errors(),
                ],
            ];

            $status = Response::HTTP_UNPROCESSABLE_ENTITY;

            $headers = [];

            return $factory->json($data, $status, $headers, $this->jsonOptions());
        });
    }
}
