<?php

namespace App\Http\Requests;

use App\Rules\Base64Image;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'id' => 'nullable|exists:products,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'selling_price' => 'nullable|numeric',
            'cost_price' => 'nullable|numeric',
            'crossed_price' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
            'sku' => 'nullable|string',
            'status' => 'required|in:active,draft',
            'options' => 'nullable|array',
            'options.*.name' => 'required|string',
            'options.*.options' => 'required|array',
            'variants' => 'nullable|array',
            'variants.*.name' => 'required|string',
            'variants.*.selling_price' => 'nullable|numeric',
            'variants.*.cost_price' => 'nullable|numeric',
            'variants.*.crossed_price' => 'nullable|numeric',
            'variants.*.quantity' => 'nullable|numeric',
            'variants.*.sku' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => ['array'],
            'images.*.image' => ['required', new Base64Image()],
            'images.*.variant' => 'nullable|string',
        ];
    }
}
