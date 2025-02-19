<?php

namespace App\Services\User;


use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    /**
     * Create a new class instance.
     */
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers(): Collection
    {
        return $this->userRepository->getAllUsers();
    }

    public function getFindUser(int $id)
    {
        return $this->userRepository->findUserByID($id);
    }
}
