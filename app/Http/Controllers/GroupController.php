<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $groups = Group::all();

        return response()->jsonSuccess($groups);
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
            'title'    => 'required|string|max:255',
            'year_min' => 'required|integer|min:1990|max:2030|lt:year_max',
            'year_max' => 'required|integer|min:1990|max:2030|gt:year_min',
            'gender'   => 'required|in:' . implode(',', array_keys(Athlete::gender())),
            'is_odd'   => 'boolean',
        ]);

        $group = Group::create($request->all());

        return response()->jsonSuccessNew($group);
    }

    /**
     * Display the specified resource.
     *
     * @param int $groupId
     * @return JsonResponse
     */
    public function show(int $groupId): JsonResponse
    {
        $group = Group::findOrFail($groupId);

        return response()->jsonSuccess($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $groupId
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $groupId): JsonResponse
    {
        $this->validate($request, [
            'title'    => 'string|max:255',
            'year_min' => 'integer|min:1990|max:2030|lt:year_max',
            'year_max' => 'integer|min:1990|max:2030|gt:year_min',
            'gender'   => 'in:' . implode(',', array_keys(Athlete::gender())),
            'is_odd'   => 'boolean',
        ]);

        $group = Group::findOrFail($groupId);
        $group->update($request->all());

        return response()->jsonSuccess($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $groupId
     * @return JsonResponse
     */
    public function destroy(int $groupId): JsonResponse
    {
        $group = Group::findOrFail($groupId);
        $group->delete();

        // TODO: Empty response?
        return response()->jsonSuccessEmpty();
    }
}
