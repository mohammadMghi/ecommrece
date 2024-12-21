<?php

namespace App\Http\Controllers\V1;
 
use App\Response\ResponseHandler;
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
                'email' => 'required|string',
                'password' => 'required|string'
            ]
        );
        try
        {
            $result = $this->userService->login($request->email,$request->password);

            if($result instanceof ResponseHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ] , $result->getStatusCode()
                );
            } 

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
        $request->validate(
            rules: [
                'email' => 'required|email',
                'password' => 'required|string'
            ]
        );
        try
        {
            $result = $this->userService->register($request->name,$request->email,$request->password);
           
            if($result instanceof ResponseHandler)
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

    public function logout(Request $request)
    {

    }
}
