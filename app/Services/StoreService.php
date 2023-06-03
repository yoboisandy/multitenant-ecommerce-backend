<?php

namespace App\Services;

use App\Jobs\CreateTenantStoreJob;
use App\Models\Tenant;
use App\Notifications\VerifyStoreRegistrationNotification;
use App\Repositories\StoreRepository;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class StoreService extends BaseService
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository, protected TenantService $tenantService)
    {
        $this->storeRepository = $storeRepository;
    }

    public function createStore($data)
    {
        return $this->withTransaction(function () use ($data) {
            $data['email_token'] = Str::uuid();

            $store = $this->storeRepository->createStore($data);

            Notification::route('mail', $store->email)->notify(new VerifyStoreRegistrationNotification($store));

            return $store;
        });
    }

    public function getStoreById($id)
    {
        return $this->storeRepository->getStoreById($id);
    }

    public function verifyStoreRegistration($store, $token)
    {
        $email_token = $store->email_token;

        if ($store->email_verified_at) {
            throw new Exception("Email already verified.");
        }
        
        if ($email_token !== $token) {
            throw new Exception("Invalid token.");
        }

        $store->update([
            'email_verified_at' => now(),
            'email_token' => null,
        ]);

        CreateTenantStoreJob::dispatch($store);
    }

    public function checkStoreReady($store)
    {
        $tenant = $this->tenantService->getTenantById($store->subdomain);

        if (!$tenant) {
            throw new Exception("Store is not ready yet.");
        }

        if (!$tenant->ready) {
            throw new Exception("Store is not ready yet.");
        }

        [$protocol, $domain] = explode('://', config('app.frontend_url'));

        $url = $protocol . '://' . $tenant->id . '.' . $domain . '/login';

        return $url;
    }
}
