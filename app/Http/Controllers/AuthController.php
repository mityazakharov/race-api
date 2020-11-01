<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Store a new user.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request): JsonResponse
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = app('hash')->make($request->input('password'));
            $user->save();

            return response()->json([
                'entity' => 'users',
                'action' => 'create',
                'result' => 'success'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'entity' => 'users',
                'action' => 'create',
                'result' => 'failed'
            ], 409);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Auth $auth
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Auth $auth, Request $request): JsonResponse
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = $auth->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get user details.
     *
     * @param Auth $auth
     * @return JsonResponse
     */
    public function me(Auth $auth): JsonResponse
    {
        return response()->json($auth->user());
    }

    /**
     * Refresh a token.
     *
     * @param Auth $auth
     * @return JsonResponse
     */
    public function refresh(Auth $auth): JsonResponse
    {
        return $this->respondWithToken($auth->refresh());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param Auth $auth
     * @return JsonResponse
     */
    public function logout(Auth $auth): JsonResponse
    {
        $auth->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => null
        ], 200);
    }
}
