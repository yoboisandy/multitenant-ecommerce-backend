<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'store_category_id' => $this->store_category_id,
            'store_category' => $this->whenLoaded('storeCategory', $this->storeCategory->name),
            'setting' =>  $this->whenLoaded('setting', new SettingResource($this->setting)),
            'customization' => $this->whenLoaded('customization', new CustomizationResource($this->customization)),
            'subdomain' => $this->subdomain,
            'plan' => $this->plan,
            'expiry_date' => $this->expiry_date,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
