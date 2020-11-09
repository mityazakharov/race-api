<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SeasonController extends Controller
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
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title'        => 'required|string|max:255',
            'year_min'     => 'required|integer|min:1990|max:2030|lt:year_max',
            'year_max'     => 'required|integer|min:1990|max:2030|gt:year_min',
            'is_odd_group' => 'required|boolean',
        ]);

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
     * @param Request $request
     * @param int $seasonId
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $seasonId): JsonResponse
    {
        $this->validate($request, [
            'title'        => 'string|max:255',
            'year_min'     => 'integer|min:1990|max:2030|lt:year_max',
            'year_max'     => 'integer|min:1990|max:2030|gt:year_min',
            'is_odd_group' => 'boolean',
        ]);

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
