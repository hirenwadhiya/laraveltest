<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserRegistrationResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use function App\Helpers\failedResponse;
use function App\Helpers\successResponse;

class UserAuthController extends Controller
{
    public function register(UserRegistrationRequest $request): JsonResponse
    {
        try {
            $userData = $request->safe()->only(['name', 'email', 'password']);
            $user = User::query()->create($userData);
            return successResponse(__('message.user.register.success'), new UserRegistrationResource($user));
        } catch (Exception $exception) {
            return failedResponse(__('message.user.register.failed'));
        }
    }
}
