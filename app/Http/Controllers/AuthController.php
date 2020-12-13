<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthorizationException;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Store a new user.
     *
     * @param RegisterAuthRequest $request
     *
     * @return JsonResponse
     */
    public function register(RegisterAuthRequest $request): JsonResponse
    {
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = app('hash')->make($request->input('password'));
            $user->save();

            return response()->jsonSuccessNew($user);

        } catch (\Exception $exception) {
            return response()->jsonException($exception);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Auth $auth
     * @param LoginAuthRequest $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function login(Auth $auth, LoginAuthRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = $auth->attempt($credentials)) {
            throw new AuthorizationException();
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
        return response()->jsonSuccess($auth->user());
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

        // TODO: Empty response?
        return response()->jsonSuccess(['message' => 'Successfully logged out']);
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
        return response()->jsonSuccess([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
