<?php

namespace App\Services\User;
 
use App\Response\ResponseHandler; 
use App\Models\User;
use App\Services\User\Contracts\IUserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function login($email , $password)
    {
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            $user = Auth::user();

            $token = $user->createToken('Ecommerce')->plainTextToken;

            return new ResponseHandler($token , 200);
        }

        return new ResponseHandler('username or password was wrong !');
    }

    public function add($name,$email,$password,$is_admin)
    {
        $user = new User();

        $user->name = $name;

        $user->email = $email;

        $user->password = Hash::make($password);

        $user->is_admin = $is_admin;

        $user->save();
    }

    public function update($id,$name,$email,$password,$is_admin)
    {
        $user = User::find($id);

        if(!$user)
        {
            return new ResponseHandler('not found' , 404);
        }

        $user->name = $name;

        $user->email = $email;

        $user->password = Hash::make($password);

        $user->is_admin = $is_admin;

        $user->save();
    }

    public function delete($id)
    {
        $user = User::find($id);

        if(!$user)
        {
            return new ResponseHandler('not found' , 404);
        }

        return $user->delete();
    }
}