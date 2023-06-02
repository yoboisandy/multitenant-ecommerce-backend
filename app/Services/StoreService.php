<?php

namespace App\Services;

use App\Repositories\StoreRepository;

class StoreService extends BaseService
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function createStore($data)
    {
        return $this->storeRepository->createStore($data);
    }
}
