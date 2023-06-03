<?php

namespace App\Services;

use App\Notifications\VerifyStoreRegistrationNotification;
use App\Repositories\StoreRepository;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class StoreService extends BaseService
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
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

        if ($email_token !== $token) {
            throw new \Exception("Invalid token");
        }

        $store->update([
            'email_verified_at' => now(),
            'email_token' => null,
        ]);
    }
}
