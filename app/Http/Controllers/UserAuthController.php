<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserLoginResource;
use App\Http\Resources\UserRegistrationResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function App\Helpers\failedResponse;
use function App\Helpers\successResponse;

class UserAuthController extends Controller
{
    public function register(UserRegistrationRequest $request): JsonResponse
    {
        try {
            $userData = $request->safe()->only(['name', 'email', 'password']);
            $user = User::query()->create($userData);
            return successResponse(__('message.user.register.success'), new UserRegistrationResource($user), Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return failedResponse(__('message.user.register.failed'));
        }
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->safe()->only(['email', 'password']);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $user->token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
                return successResponse(__('message.user.login.success'), new UserLoginResource($user));
            }
            return failedResponse(__('auth.failed'), [], Response::HTTP_UNAUTHORIZED);
        } catch (Exception $exception) {
            return failedResponse(__('message.user.login.failed'));
        }
    }

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return successResponse(__('message.user.logout.success'));
        } catch (Exception $exception) {
            return failedResponse(__('message.user.logout.failed'));
        }
    }
}
