<?php

namespace App\Services\Register;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        // Criando o usuário
        $user = $this->userRepository->create($data);
        $token = $user->createToken('Personal Access Token')->plainTextToken;
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
