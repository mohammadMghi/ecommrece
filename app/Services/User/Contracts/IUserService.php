<?php

namespace App\Services\User\Contracts;

use App\Models\User;

interface IUserService
{
    public function login($username , $password);

    public function logout();

    public function register($name , $email, $password);

    public function add($name,$email,$password,$is_admin);
 
    public function update($id,$name,$email,$password,$is_admin);

    public function delete($id);
}