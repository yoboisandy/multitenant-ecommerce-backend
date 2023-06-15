<?php

namespace App\Repositories;

use App\Models\Tenant;

class TenantRepository
{
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function createTenant($data)
    {
        return $this->tenant->create($data);
    }

    public function getTenantById($id)
    {
        return $this->tenant->findOrFail($id);
    }

    public function getAllTenantsWithInIds($ids)
    {
        return $this->tenant->whereIn('id', $ids)->get();
    }
}
