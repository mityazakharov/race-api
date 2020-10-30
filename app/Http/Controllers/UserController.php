<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return response()->jsonSuccess($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = User::create($request->all());

        return response()->jsonSuccessNew($user);
    }

    /**
     * Display the specified resource.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show(int $userId): JsonResponse
    {
        $user = User::findOrFail($userId);

        return response()->jsonSuccess($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $userId
     * @return JsonResponse
     */
    public function update(Request $request, int $userId): JsonResponse
    {
        $user = User::findOrFail($userId);
        $user->update($request->all());

        return response()->jsonSuccess($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function destroy(int $userId): JsonResponse
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return response()->jsonSuccessEmpty();
    }
}
