<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function createToken(User $user)
    {
        return $user->createToken('authToken')->plainTextToken;
    }

    public function deleteToken(User $user)
    {
        $user->tokens()->delete();
    }
}
