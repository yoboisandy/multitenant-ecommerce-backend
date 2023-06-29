<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService extends BaseService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories()
    {
        return $this->categoryRepository->getCategories();
    }

    public function createCategory($data)
    {
        if ($data['image']) {
            $data['image'] = ImageService::uploadImage($data['image'], 'categories');
        }
        return $this->categoryRepository->createCategory($data);
    }

    public function updateCategory($data, $id)
    {

        if ($data['image']) {
            $oldImage = $this->categoryRepository->getCategoryById($id)->image;
            $data['image'] = ImageService::updateImage($data['image'], 'categories', $oldImage);
        }
        return $this->categoryRepository->updateCategory($data, $id);
    }

    public function deleteCategory($id)
    {
        if ($this->categoryRepository->getCategoryById($id)->image) {
            $oldImage = $this->categoryRepository->getCategoryById($id)->image;
            ImageService::deleteImage($oldImage);
        }
        return $this->categoryRepository->deleteCategory($id);
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }
}
