<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Models\Result;
use Illuminate\Http\JsonResponse;

class ResultController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $results = Result::all();

        return response()->jsonSuccess($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateResultRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateResultRequest $request): JsonResponse
    {
        $result = Result::create($request->all());

        return response()->jsonSuccessNew($result);
    }

    /**
     * Display the specified resource.
     *
     * @param int $resultId
     * @return JsonResponse
     */
    public function show(int $resultId): JsonResponse
    {
        $result = Result::findOrFail($resultId);

        return response()->jsonSuccess($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateResultRequest $request
     * @param int $resultId
     *
     * @return JsonResponse
     */
    public function update(UpdateResultRequest $request, int $resultId): JsonResponse
    {
        $result = Result::findOrFail($resultId);
        $result->update($request->all());

        return response()->jsonSuccess($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $resultId
     * @return JsonResponse
     */
    public function destroy(int $resultId): JsonResponse
    {
        $result = Result::findOrFail($resultId);
        $result->delete();

        // TODO: Empty response?
        return response()->jsonSuccessEmpty();
    }

    /**
     * Return result status names
     *
     * @return JsonResponse
     */
    public function statuses(): JsonResponse
    {
        return response()->jsonSuccess(Result::statuses());
    }
}
