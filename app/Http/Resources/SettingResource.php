<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "store_id" => $this->store_id,
            "store_fb" => $this->store_fb,
            "store_ig" => $this->store_ig,
            "store_tiktok" => $this->store_tiktok,
            "store_whatsapp" => $this->store_whatsapp,
            "delivery_charge" => $this->delivery_charge,
            "delivery_time" => $this->delivery_time,
        ];
    }
}
