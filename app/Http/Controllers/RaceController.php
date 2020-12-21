<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRaceRequest;
use App\Http\Requests\UpdateRaceRequest;
use App\Models\Race;
use Illuminate\Http\JsonResponse;

class RaceController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $races = Race::all();

        return response()->jsonSuccess($races);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRaceRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateRaceRequest $request): JsonResponse
    {
        $race = Race::create($request->all());

        return response()->jsonSuccessNew($race);
    }

    /**
     * Display the specified resource.
     *
     * @param int $raceId
     * @return JsonResponse
     */
    public function show(int $raceId): JsonResponse
    {
        $race = Race::findOrFail($raceId);

        return response()->jsonSuccess($race);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRaceRequest $request
     * @param int $raceId
     *
     * @return JsonResponse
     */
    public function update(UpdateRaceRequest $request, int $raceId): JsonResponse
    {
        $race = Race::findOrFail($raceId);
        $race->update($request->all());

        return response()->jsonSuccess($race);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $raceId
     * @return JsonResponse
     */
    public function destroy(int $raceId): JsonResponse
    {
        $race = Race::findOrFail($raceId);
        $race->delete();

        // TODO: Empty response?
        return response()->jsonSuccessEmpty();
    }
}
