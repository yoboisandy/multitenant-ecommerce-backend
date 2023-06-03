<?php

namespace App\Services;

use App\Repositories\TenantRepository;

class TenantService extends BaseService
{
    protected $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    public function createTenant($data)
    {
        return $this->tenantRepository->createTenant($data);
    }

    public function getTenantById($id)
    {
        return $this->tenantRepository->getTenantById($id);
    }
}
