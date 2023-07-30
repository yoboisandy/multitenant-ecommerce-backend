<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "customer_name" => ["required", "string"],
            "customer_email" => ["required", "string", "email"],
            "customer_phone" => ["required", "string"],
            "customer_address_province" => ["required", "string"],
            "customer_address_city" => ["required", "string"],
            "customer_address_area" => ["required", "string"],
            "customer_address_nearby_landmark" => ["nullable", "string"],
            "order_note" => ["nullable", "string"],
            "payment_method" => ["required", "string"],
            "products" => ["required", "array"],
            "products.*.id" => ["required", "string"],
            "products.*.variant_id" => ["nullable", "string"],
            "products.*.quantity" => ["required", "integer"],
        ];
    }
}
