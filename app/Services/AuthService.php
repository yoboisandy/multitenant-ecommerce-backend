<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StoreResource;
use App\Models\StoreCategory;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{
    public function __construct(
        public UserService $userService,
        public StoreService $storeService,
        public CategoryService $categoryService,
        public ProductService $productService
    )
    {
        //
    }

    public function login($email, $password)
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        if (!Auth::attempt($credentials)) {
            throw new Exception('Incorrect email or password. Please try again or reset your password.', 401);
        }

        $user = $this->userService->getUserById(Auth::id());
        $token = $this->userService->createToken($user);
        return $token;
    }

    public function logout()
    {
        $user = $this->userService->getUserById(Auth::id());
        $this->userService->deleteToken($user);
    }

    public function getConfigs()
    {
        if (tenant()) {
            $storeId = tenant('store_id');
            $store = tenancy()->central(function ()  use ($storeId) {
                return new StoreResource($this->storeService->getStoreById($storeId));
            });
            $categories = CategoryResource::collection($this->categoryService->getCategories());
            $newArrivals = ProductResource::collection($this->productService->getNewArrivals(10));
            $trendingProducts = [];
        }
        $configs = [
            "isTenant" => tenant() ? true : false,
            "store" => $store ?? null,
            "categories" => $categories ?? [],
            "newArrivals" => $newArrivals ?? [],
            "trendingProducts" => $trendingProducts ?? [],
        ];
        return $configs;
    }
}
