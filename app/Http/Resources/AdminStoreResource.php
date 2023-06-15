<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'store_name' => $this->store_name,
            'store_category' => $this->storeCategory->name,
            'subdomain' => $this->subdomain,
            'url' => $this->url,
            'plan' => $this->plan,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
