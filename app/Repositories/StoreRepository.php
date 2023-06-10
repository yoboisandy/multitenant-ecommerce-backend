<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository
{
    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function createStore($data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->store->create($data);
    }

    public function getStoreById($id)
    {
        return $this->store->findOrFail($id);
    }

    public function getStores()
    {
        return $this->store->with('storeCategory')->get();
    }
}
