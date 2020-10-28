<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Controller
{
    /**
     * Json output options
     */
    const JSON_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;

    /**
     * HTTP status codes
     */
    const STATUS_CODE_OK = 200;
    const STATUS_CODE_CREATED = 201;
    const STATUS_CODE_NO_CONTENT = 204;

    /**
     * Response Json on success
     *
     * @param mixed $data
     * @return JsonResponse
     */
    protected function success($data): JsonResponse
    {
        return response()->json([
            'result' => 'success',
            'data'   => $data,
        ], self::STATUS_CODE_OK, [], self::JSON_OPTIONS);
    }

    /**
     * Response Json on success (for newly created data)
     *
     * @param $data
     * @return JsonResponse
     */
    protected function successNew($data): JsonResponse
    {
        $headers = [
            'Location' => URL::current() . '/' . $data->id,
        ];

        return response()->json([
            'result' => 'success',
            'data'   => $data,
        ], self::STATUS_CODE_CREATED, $headers, self::JSON_OPTIONS);
    }

    /**
     * Empty response Json on success (ex. DELETE)
     *
     * @return JsonResponse
     */
    protected function successEmpty(): JsonResponse
    {
        return response()->json([
            'result' => 'success',
        ], self::STATUS_CODE_NO_CONTENT, [], self::JSON_OPTIONS);
    }


}
