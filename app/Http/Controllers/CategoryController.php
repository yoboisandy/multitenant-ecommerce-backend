<?php

namespace App\Http\Controllers;

use App\Libs\ApiResponse;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(public CategoryService $categoryService)
    {
    }

    public function index()
    {
        $categories = $this->categoryService->getCategories();

        return ApiResponse::success($categories);
    }
}
