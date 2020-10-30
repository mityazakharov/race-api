<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Lumen\Http\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

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
         * Response Json on success
         */
        $factory->macro('jsonSuccess', function ($rawData) use ($factory) {
            $data = [
                'result' => 'success',
                'data'   => $rawData,
            ];

            return $factory->json($data, Response::HTTP_OK, [], $this->jsonOptions());
        });

        /**
         * Response Json on success (for newly created data)
         */
        $factory->macro('jsonSuccessNew', function ($rawData) use ($factory) {
            $data = [
                'result' => 'success',
                'data' => $rawData,
            ];

            $headers = [
                'Location' => URL::current() . '/' . $rawData->id,
            ];

            return $factory->json($data, Response::HTTP_CREATED, $headers, $this->jsonOptions());
        });

        /**
         * Empty response Json on success (ex. DELETE)
         */
        $factory->macro('jsonSuccessEmpty', function () use ($factory) {
            $data = [
                'result' => 'success',
            ];

            return $factory->json($data, Response::HTTP_OK, [], $this->jsonOptions());
        });

        // TODO: реализовать ответы с ошибками
        $factory->macro('jsonFailure', function (string $message = '', $errors = []) use ($factory){
            $error = [
                'result' => 'failure',
                'message' => $message,
                'errors' => $errors,
            ];

            return $factory->json($error, Response::HTTP_BAD_REQUEST, [],  $this->jsonOptions());
        });
    }
}
