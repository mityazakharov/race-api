<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAthleteRequest;
use App\Http\Requests\UpdateAthleteRequest;
use App\Models\Athlete;
use Illuminate\Http\JsonResponse;

class AthleteController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $athletes = Athlete::all();

        return response()->jsonSuccess($athletes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAthleteRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateAthleteRequest $request): JsonResponse
    {
        $athlete = Athlete::create($request->all());

        return response()->jsonSuccessNew($athlete);
    }

    /**
     * Display the specified resource.
     *
     * @param int $athleteId
     * @return JsonResponse
     */
    public function show(int $athleteId): JsonResponse
    {
        $athlete = Athlete::findOrFail($athleteId);

        return response()->jsonSuccess($athlete);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAthleteRequest $request
     * @param int $athleteId
     *
     * @return JsonResponse
     */
    public function update(UpdateAthleteRequest $request, int $athleteId): JsonResponse
    {
        $athlete = Athlete::findOrFail($athleteId);
        $athlete->update($request->all());

        return response()->jsonSuccess($athlete);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $athleteId
     * @return JsonResponse
     */
    public function destroy(int $athleteId): JsonResponse
    {
        $athlete = Athlete::findOrFail($athleteId);
        $athlete->delete();

        // TODO: Empty response?
        return response()->jsonSuccessEmpty();
    }

    /**
     * Return gender characters
     *
     * @return JsonResponse
     */
    public function gender(): JsonResponse
    {
        return response()->jsonSuccess(Athlete::gender());
    }

    /**
     * Return sport rate names
     *
     * @return JsonResponse
     */
    public function rates(): JsonResponse
    {
        return response()->jsonSuccess(Athlete::rates());
    }
}
