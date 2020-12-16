<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDisciplineRequest;
use App\Http\Requests\UpdateDisciplineRequest;
use App\Models\Discipline;
use Illuminate\Http\JsonResponse;

class DisciplineController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $disciplines = Discipline::all();

        return response()->jsonSuccess($disciplines);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDisciplineRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateDisciplineRequest $request): JsonResponse
    {
        $discipline = Discipline::create($request->all());

        return response()->jsonSuccessNew($discipline);
    }

    /**
     * Display the specified resource.
     *
     * @param int $disciplineId
     * @return JsonResponse
     */
    public function show(int $disciplineId): JsonResponse
    {
        $discipline = Discipline::findOrFail($disciplineId);

        return response()->jsonSuccess($discipline);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDisciplineRequest $request
     * @param int $disciplineId
     *
     * @return JsonResponse
     */
    public function update(UpdateDisciplineRequest $request, int $disciplineId): JsonResponse
    {
        $discipline = Discipline::findOrFail($disciplineId);
        $discipline->update($request->all());

        return response()->jsonSuccess($discipline);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $disciplineId
     * @return JsonResponse
     */
    public function destroy(int $disciplineId): JsonResponse
    {
        $discipline = Discipline::findOrFail($disciplineId);
        $discipline->delete();

        // TODO: Empty response?
        return response()->jsonSuccessEmpty();
    }

}
