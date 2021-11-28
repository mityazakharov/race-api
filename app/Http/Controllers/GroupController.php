<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\JsonResponse;

class GroupController
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
     * @param CreateGroupRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateGroupRequest $request): JsonResponse
    {
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
        $group->load('seasons:id,title,year_min,year_max,is_odd_group');

        return response()->jsonSuccess($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGroupRequest $request
     * @param int $groupId
     *
     * @return JsonResponse
     */
    public function update(UpdateGroupRequest $request, int $groupId): JsonResponse
    {
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
