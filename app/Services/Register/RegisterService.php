<?php

namespace App\Services\Register;

use App\Models\User;
use App\Notifications\UserRegistered;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class RegisterService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Registra um novo usuário e retorna o usuário criado.
     *
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User
    {
        $user = $this->userRepository->create($data);
        $user->createToken('Personal Access Token')->plainTextToken;

        Notification::send($user, new UserRegistered($user));

        return $user;
    }

    public function login(array $credenciais): JsonResponse
    {
        $token = $this->userRepository->login($credenciais);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}
