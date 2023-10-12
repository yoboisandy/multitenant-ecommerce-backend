<?php

namespace App\Repositories;

use App\Models\Store;
use App\Models\Tenant;
use App\Services\ImageService;

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
            if (isset($data['setting'])) {
                $store->setting()->update($data['setting']);
            }
        } else {
            $store->setting()->create($data['setting'] ?? []);
        }

        if ($store->customization) {
            if (isset($data['customization'])) {
                if (isset($data['customization']['logo'])) {
                    $data['customization']['logo'] = ImageService::updateImage($data['customization']['logo'], "store_customization_logo", $store->customization?->logo ?? null);
                }
                if (isset($data['customization']['favicon'])) {
                    $data['customization']['favicon'] = ImageService::updateImage($data['customization']['favicon'], "store_customization_favicon", $store->customization?->favicon ?? null);
                }
                if (isset($data['customization']['hero_image'])) {
                    $data['customization']['hero_image'] = ImageService::updateImage($data['customization']['hero_image'], "store_customization_hero_image", $store->customization?->hero_image ?? null);
                }
                if (isset($data['customization']['ad1_image'])) {
                    $data['customization']['ad1_image'] = ImageService::updateImage($data['customization']['ad1_image'], "store_customization_ad1_image", $store->customization?->ad1_image ?? null);
                }
                if (isset($data['customization']['ad2_image'])) {
                    $data['customization']['ad2_image'] = ImageService::updateImage($data['customization']['ad2_image'], "store_customization_ad2_image", $store->customization?->ad2_image ?? null);
                }
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

    public function updateStorePlan($id, $plan)
    {
        $store = $this->store->findOrFail($id);
        $store->update([
            'plan' => $plan,
        ]);

        $tenant = Tenant::where('id', $store->subdomain)->first();
        $tenant->update([
            'plan' => $plan,
        ]);

        return $store;
    }
}
