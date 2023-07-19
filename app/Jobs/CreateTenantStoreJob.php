<?php

namespace App\Jobs;

use App\Models\Store;
use App\Models\Tenant;
use App\Models\User;
use App\Notifications\StoreReadyNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class CreateTenantStoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Store $store)
    {
        // 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger('Creating tenant store...' . $this->store->subdomain);
        try {
            $tenant = Tenant::create([
                'id' => $this->store->subdomain,
                'plan' => 'free',
                'ready' => false,
                'store_name' => $this->store->store_name,
                'store_id' => $this->store->id,
            ]);

            [$protocol, $domain] = explode('://', config('app.frontend_url'));
            $url = $tenant->id . '.' . $domain;

            $tenant->createDomain(['domain' => $url]);

            Config::set('database.connections.mysql.database', 'mecom_' . $tenant->id);

            $user = $tenant->run(function () {
                // Create User
                $user = User::create([
                    'name' => $this->store->user_name,
                    'email' => $this->store->email,
                    'password' => $this->store->password,
                    'phone' => $this->store->phone,
                ]);

                $user->assignRole('owner');

                return $user;
            });

            $tenant->update(['ready' => true]);

            $user->notify(new StoreReadyNotification($this->store));
            logger('Tenant store created successfully...' . $this->store->subdomain);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
