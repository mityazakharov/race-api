<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TeamController extends Controller
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
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:teams',
        ]);
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
     * @param Request $request
     * @param int $teamId
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $teamId): JsonResponse
    {
        $this->validate($request, [
            'title' => 'string|max:255|unique:teams,title,' . $teamId,
        ]);

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
