<?php

namespace App\Services\User\Contracts;

use App\Models\User;

interface IUserService
{
    public function login($username , $password);

    public function logout();

    public function register(User $user);
}