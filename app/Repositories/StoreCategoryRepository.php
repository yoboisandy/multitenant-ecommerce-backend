<?php

namespace App\Repositories;

use App\Models\StoreCategory;

class StoreCategoryRepository
{
    protected $storeCategory;

    public function __construct(StoreCategory $storeCategory)
    {
        $this->storeCategory = $storeCategory;
    }

    public function getCategories()
    {
        return $this->storeCategory->select('id', 'name')->get();
    }
}
