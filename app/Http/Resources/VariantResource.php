<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isOwner = auth()->user()?->hasRole('owner');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'selling_price' => $this->selling_price,
            'cost_price' => $this->when($isOwner, $this->cost_price),
            'crossed_price' => $this->crossed_price,
            'quantity' => $this->quantity,
            'sku' => $this->sku,
        ];
    }
}
