<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSeasonRequest;
use App\Http\Requests\UpdateSeasonRequest;
use App\Models\Season;
use Illuminate\Http\JsonResponse;

class SeasonController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $seasons = Season::all();

        return response()->jsonSuccess($seasons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSeasonRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateSeasonRequest $request): JsonResponse
    {
        $season = Season::create($request->all());

        return response()->jsonSuccessNew($season);
    }

    /**
     * Display the specified resource.
     *
     * @param int $seasonId
     * @return JsonResponse
     */
    public function show(int $seasonId): JsonResponse
    {
        $season = Season::findOrFail($seasonId);

        return response()->jsonSuccess($season);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSeasonRequest $request
     * @param int $seasonId
     *
     * @return JsonResponse
     */
    public function update(UpdateSeasonRequest $request, int $seasonId): JsonResponse
    {
        $season = Season::findOrFail($seasonId);
        $season->update($request->all());

        return response()->jsonSuccess($season);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $seasonId
     * @return JsonResponse
     */
    public function destroy(int $seasonId): JsonResponse
    {
        $season = Season::findOrFail($seasonId);
        $season->delete();

        // TODO: Empty response?
        return response()->jsonSuccessEmpty();
    }
}
