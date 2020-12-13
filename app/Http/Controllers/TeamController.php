<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Http\JsonResponse;

class TeamController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $teams = Team::all();

        return response()->jsonSuccess($teams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTeamRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateTeamRequest $request): JsonResponse
    {
        $team = Team::create($request->all());

        return response()->jsonSuccessNew($team);
    }

    /**
     * Display the specified resource.
     *
     * @param int $teamId
     * @return JsonResponse
     */
    public function show(int $teamId): JsonResponse
    {
        $team = Team::findOrFail($teamId);

        return response()->jsonSuccess($team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTeamRequest $request
     * @param int $teamId
     *
     * @return JsonResponse
     */
    public function update(UpdateTeamRequest $request, int $teamId): JsonResponse
    {
        $team = Team::findOrFail($teamId);
        $team->update($request->all());

        return response()->jsonSuccess($team);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $teamId
     * @return JsonResponse
     */
    public function destroy(int $teamId): JsonResponse
    {
        $team = Team::findOrFail($teamId);
        $team->delete();

        // TODO: Empty response?
        return response()->jsonSuccessEmpty();
    }

}
