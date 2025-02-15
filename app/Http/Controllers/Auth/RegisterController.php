<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Register\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    protected RegisterService $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->registerService->registerUser($request->all());

        return response()->json($user, Response::HTTP_OK);
    }

    public function login(Request $request): JsonResponse
    {
        $credenciais = $request->only('email', 'password');

        return $this->registerService->login($credenciais);
    }
}
