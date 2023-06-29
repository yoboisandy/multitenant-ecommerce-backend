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
        return $this->category->select('id', 'name', 'description', 'image')->latest()->get();
    }

    public function createCategory($data)
    {
        return $this->category->create($data)->only('id', 'name', 'description', 'image');
    }

    public function updateCategory($data, $id)
    {
        $this->category->where('id', $id)->update($data);
        return $this->category->find($id)->only('id', 'name', 'description', 'image');
    }

    public function deleteCategory($id)
    {
        return $this->category->where('id', $id)->delete();
    }

    public function getCategoryById($id)
    {
        return $this->category->findOrFail($id);
    }
}
