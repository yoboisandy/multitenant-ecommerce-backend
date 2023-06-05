<?php

namespace App\Http\Controllers;

use App\Libs\ApiResponse;
use App\Services\StoreCategoryService;

class StoreCategoryController extends Controller
{
    public function __construct(public StoreCategoryService $storeCategoryService)
    {
    }

    public function index()
    {
        $categories = $this->storeCategoryService->getCategories();

        return ApiResponse::success($categories);
    }
}
