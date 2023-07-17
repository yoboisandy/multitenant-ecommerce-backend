<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update(array $data, $id)
    {
        $product = $this->product->findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        return $this->product->findOrFail($id)->delete();
    }

    public function find($id)
    {
        return $this->product->with('options', 'variants', 'product_images', 'category')->findOrFail($id);
    }

    public function getAllProducts($status)
    {
        $products = $this->product->with('options', 'variants', 'product_images', 'category')->latest();

        if ($status) {
            $products = $products->where('status', $status);
        }

        return $products->get();
    }

    public function deleteProduct($id)
    {
        $product = $this->product->findOrFail($id);
        $data = $product;
        $product->options()->delete();
        $product->variants()->delete();
        $product->product_images()->delete();
        $product->delete();
        return $data;
    }
}
