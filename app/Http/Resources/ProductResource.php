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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            'cost_price' => $this->cost_price,
            'crossed_price' => $this->crossed_price,
            'quantity' => $this->quantity,
            'sku' => $this->sku,
            'status' => $this->status,
            'category' => $this->whenLoaded('category', new CategoryResource($this->category)),
            'options' => $this->whenLoaded('options', OptionResource::collection($this->options)),
            'variants' => $this->whenLoaded('variants', VariantResource::collection($this->variants)),
            'product_images' => $this->whenLoaded('product_images',  $this->product_images->pluck('image')->toArray()),
        ];
    }
}
