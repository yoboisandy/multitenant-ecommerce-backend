<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Resources\StoreResource;
use App\Libs\ApiResponse;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct(public StoreService $storeService)
    {
    }

    public function store(StoreRegistrationRequest $request)
    {
        $data = $request->validated();

        $store = $this->storeService->createStore($data);

        return ApiResponse::success(new StoreResource($store), "Store created successfully. Please check your email to verify your account.");
    }
}
