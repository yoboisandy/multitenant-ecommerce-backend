<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserById($id)
    {
        $user = $this->user->select('id', 'name', 'avatar', 'phone', 'email')->findOrFail($id);

        $user['roles'] = $user->roles()->pluck('name');

        return $user;
    }
}
