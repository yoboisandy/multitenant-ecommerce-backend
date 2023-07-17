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

    public function getAllProducts(Request $request)
    {
        $status = $request->status ?? null;
        return ApiResponse::success(ProductResource::collection($this->productService->getAllProducts($status)), "Products fetched successfully.");
    }

    public function save(ProductRequest $request)
    {
        return ApiResponse::success($this->productService->save($request->validated(), !empty($request->id)), "Product saved successfully.");
    }

    public function getProduct($id)
    {
        return ApiResponse::success(new ProductResource($this->productService->getProduct($id)), "Product fetched successfully.");
    }

    public function deleteProduct($id)
    {
        $this->productService->deleteProduct($id);
        return ApiResponse::success([], "Product deleted successfully.");
    }
}
