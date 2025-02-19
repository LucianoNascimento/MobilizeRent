<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAllUsers(): Collection;
    public function findUserByID(int $id): ?User;


    public function create(array $data): User;

    public function login(array $credentials): ?string;
}
