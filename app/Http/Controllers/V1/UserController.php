<?php

namespace App\Http\Controllers\V1;

use App\Error\ErrorHandler;
use App\Http\Controllers\Controller;
use App\Services\User\Contracts\IUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected IUserService $userService;
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string',
                'password' => 'required|string'
            ]
        );
        try
        {
            $result = $this->userService->login($request->username,$request->password);

            if($result instanceof ErrorHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ] , $result->getStatusCode()
                );
            }

            return response()->json(
                [
                    'token' => $result
                ]
            );

        }catch(\Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }   
    }

    public function register(Request $request)
    {

    }

    public function logout(Request $request)
    {

    }
}
