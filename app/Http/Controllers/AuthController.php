<?php

namespace App\Http\Controllers;

use App\Libs\ApiResponse;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService, public UserService $userService)
    {
    }

    public  function login(Request $request)
    {
        return ApiResponse::success([
            'token' =>  $this->authService->login($request->email, $request->password),
            'user' => $this->userService->getUserById(Auth::id()),
        ]);
    }

    public function logout()
    {
        $this->authService->logout();
        return ApiResponse::success([], 'Logged out successfully');
    }

    public function me()
    {
        $user = $this->userService->getUserById(Auth::id());
        return ApiResponse::success($user);
    }
}
