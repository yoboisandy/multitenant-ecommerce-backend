<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Libs\ApiResponse;
use App\Models\Category;
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

    public function store(CategoryRequest $request)
    {
        return ApiResponse::success(
            $this->categoryService->createCategory($request->validated()),
            "Category created successfully."
        );
    }
}
