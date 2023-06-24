<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategories()
    {
        return $this->category->select('id', 'name', 'description', 'image')->get();
    }

    public function createCategory($data)
    {
        return $this->category->create($data)->only('id', 'name', 'description', 'image');
    }
}
