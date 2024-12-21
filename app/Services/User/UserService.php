<?php

namespace App\Services\User;
 
use App\Response\ResponseHandler; 
use App\Models\User;
use App\Services\User\Contracts\IUserService;
use Illuminate\Support\Facades\Auth;

class UserService implements IUserService
{
    public function register($name ,$email , $password)
    {   
        $user = User::where('email' , $email)->first();

        if($user) return new ResponseHandler('Another user with this email has registered before' , 400);

        $user = new User();

        $user->email = $email;

        $user->password = $password;

        $user->name = $name;

        $user->save();

        return new ResponseHandler('Successfully registered' , 200);
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

        return new ResponseHandler('username or password was wrong !');
    }
}