<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AthleteController extends Controller
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
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'year'       => 'required|integer|min:1990|max:2030',
            'gender'     => 'required|in:' . implode(',', array_keys(Athlete::gender())),
            'team_id'    => 'required|exists:teams,id',
            'rate'       => 'required|in:' . implode(',', Athlete::rates()),
        ]);

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
     * @param Request $request
     * @param int $athleteId
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $athleteId): JsonResponse
    {
        $this->validate($request, [
            'first_name' => 'string|max:255',
            'last_name'  => 'string|max:255',
            'year'       => 'integer|min:1990|max:2030',
            'gender'     => 'in:' . implode(',', array_keys(Athlete::gender())),
            'team_id'    => 'exists:teams,id',
            'rate'       => 'in:' . implode(',', Athlete::rates()),
        ]);

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
