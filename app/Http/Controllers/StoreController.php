<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Resources\AdminStoreResource;
use App\Http\Resources\StoreResource;
use App\Libs\ApiResponse;
use App\Models\Store;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct(public StoreService $storeService)
    {
    }

    public function store(StoreRegistrationRequest $request)
    {
        $store = $this->storeService->createStore($request->validated());

        return ApiResponse::success(new StoreResource($store), "Store created successfully. Please check your email to verify your account.");
    }

    public function verifyStoreRegistration(Store $store, $token)
    {
        $store = $this->storeService->verifyStoreRegistration($store, $token);

        return ApiResponse::success([], "Store verified successfully.");
    }

    public function checkStoreReady(Store $store)
    {
        $url = $this->storeService->checkStoreReady($store);

        return ApiResponse::success(["url" => $url], "Store is ready.");
    }

    public function getStores()
    {
        $stores = $this->storeService->getAllStores();

        return ApiResponse::success(AdminStoreResource::collection($stores));
    }

    public function getCurrentStore()
    {
        $id = tenant('store_id');
        $store = tenancy()->central(function () use ($id) {
            return $this->storeService->getStoreById($id);
        });

        return ApiResponse::success(new StoreResource($store));
    }

    public function updateStore(Request $request)
    {
        $id = tenant('store_id');

        $store = tenancy()->central(function () use ($id, $request) {
            return $this->storeService->updateStore($id, $request->all());
        });

        return ApiResponse::success(new StoreResource($store), "Store updated successfully.");
    }
}
