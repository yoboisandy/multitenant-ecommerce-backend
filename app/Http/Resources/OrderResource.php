<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
            'customer_address_province' => $this->customer_address_province,
            'customer_address_city' => $this->customer_address_city,
            'customer_address_area' => $this->customer_address_area,
            'customer_address_nearby_landmark' => $this->customer_address_nearby_landmark,
            'order_note' => $this->order_note,
            'total_price' => $this->total_price,
            'total_quantity' => $this->total_quantity,
            'delivery_charge' => $this->delivery_charge,
            'order_status' => $this->order_status,
            'payment_status' => $this->payment_status,
            'payment_method' => $this->payment_method,
            'products' => $this->products,
            'created_at' => Carbon::parse($this->created_at)->format('d M Y h:i A'),
        ];
    }
}
