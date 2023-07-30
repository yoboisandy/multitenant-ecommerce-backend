<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            'cost_price' => $this->when($isOwner, $this->cost_price),
            'crossed_price' => $this->crossed_price,
            'quantity' => $this->quantity,
            'sku' => $this->when($isOwner, $this->sku),
            'status' => $this->when($isOwner, $this->status),
            'category' => $this->whenLoaded('category', new CategoryResource($this->category)),
            'options' => $this->whenLoaded('options', OptionResource::collection($this->options)),
            'variants' => $this->whenLoaded('variants', VariantResource::collection($this->variants)),
            'product_images' => $this->whenLoaded('product_images', ProductImageResource::collection($this->product_images)),
            'created_at' => $this->created_at->format('M d, Y'),
        ];
    }
}
