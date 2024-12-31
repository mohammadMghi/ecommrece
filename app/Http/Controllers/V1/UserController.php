<?php

namespace App\Http\Controllers\V1;
 
use App\Response\ResponseHandler;
use App\Http\Controllers\Controller;
use App\Services\User\Contracts\IUserService;
use Exception;
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

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:8',
            'is_admin' => 'required|boolean',
            'email' => 'required|email|unique:users,email',
        ]);

        try
        {
            $result = $this->userService->add(
                $request->name,
                $request->email,
                $request->password,
                $request->is_admin,
            );

            if($result instanceof ResponseHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ] , $result->getStatusCode()
                );
            }

            return response()->noContent(201);

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }

    public function update(Request $request,int $id)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:8',
            'is_admin' => 'required|boolean',
            'email' => 'required|email|unique:users,email',
        ]);

        try
        {
            $result = $this->userService->update(
                $id,
                $request->name,
                $request->email,
                $request->password,
                $request->is_admin,
            );

            if($result instanceof ResponseHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ] , $result->getStatusCode()
                );
            }

            return response()->noContent(201);

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }

    public function delete(int $id)
    { 
        try
        {
            $result = $this->userService->delete($id);

            if($result instanceof ResponseHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ] , $result->getStatusCode()
                );
            }

            return response()->noContent(200);

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }
}
