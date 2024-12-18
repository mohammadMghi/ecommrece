<?php

namespace App\Services\User;

use App\Error\ErrorHandler;
use App\Error\ErrorHandling;
use App\Models\User;
use App\Services\User\Contracts\IUserService;
use Illuminate\Support\Facades\Auth;

class UserService implements IUserService
{
    public function register(User $user)
    {

    } 

    public function logout()
    {

    }

    public function login($username , $password)
    {
        if(Auth::attempt(['username' => $username, 'password' => $password]))
        {
            $user = Auth::user();

            $token = $user->createToken('Ecommerce')->plainTextToken;

            return $token;
        }

        return new ErrorHandler('username or password was wrong !');
    }
}