<?php

namespace App\Application\Controllers;

use App\Application\Requests\GetUserRequest;
use App\Application\Responses\UserResponse;
use App\Application\UseCases\GetUserUseCase;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private GetUserUseCase $getUserUseCase
    ) {}

    public function show(int $id): JsonResponse
    {
        $request = new GetUserRequest($id);
        $user = $this->getUserUseCase->execute($request->userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(UserResponse::fromUser($user));
    }
}
