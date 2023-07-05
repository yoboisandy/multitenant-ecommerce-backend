<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Libs\ApiResponse;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(public ProductService $productService)
    {
    }

    public function getAllProducts()
    {
        return ApiResponse::success(ProductResource::collection($this->productService->getAllProducts()), "Products fetched successfully.");
    }

    public function save(ProductRequest $request)
    {
        return ApiResponse::success($this->productService->save($request->validated()), "Product saved successfully.");
    }
}
