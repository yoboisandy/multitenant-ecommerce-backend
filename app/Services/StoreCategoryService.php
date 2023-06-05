<?php

namespace App\Services;

use App\Repositories\StoreCategoryRepository;

class StoreCategoryService extends BaseService
{
    protected $storeCategoryRepository;

    public function __construct(StoreCategoryRepository $storeCategoryRepository)
    {
        $this->storeCategoryRepository = $storeCategoryRepository;
    }

    public function getCategories()
    {
        return $this->storeCategoryRepository->getCategories();
    }
}
