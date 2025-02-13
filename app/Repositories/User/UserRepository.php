<?php

namespace App\Repositories\User;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' => $data['user_type'],
        ]);
    }

    public function login(array $credentials): ?string
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        $user = Auth::user();
        return $user->createToken('Personal Access Token')->plainTextToken;
    }
}
