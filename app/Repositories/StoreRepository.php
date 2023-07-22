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
        $store = $this->store->create($data);

        $store->setting()->create($data['setting'] ?? []);
        $store->customization()->create($data['customization'] ?? []);

        return $store->load('setting', 'customization');
    }

    public function updateStore($id, $data)
    {
        $store = $this->store->findOrFail($id);
        $store->update($data);
        if ($store->setting) {
            $store->setting()->update($data['setting']);
        } else {
            $store->setting()->create($data['setting'] ?? []);
        }

        if ($store->customization) {
            if (isset($data['customization'])) {
                $store->customization()->update($data['customization']);
            }
        } else {
            $store->customization()->create($data['customization'] ?? []);
        }

        return $store->load('setting', 'customization');
    }

    public function getStoreById($id)
    {
        return $this->store->findOrFail($id)->load('storeCategory', 'setting');
    }

    public function getStores()
    {
        return $this->store->with('storeCategory', 'setting')->get();
    }
}
