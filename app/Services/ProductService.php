<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function save(array $data, bool $update = false)
    {
        return $this->withTransaction(function () use ($data, $update) {
            if ($update) {
                $product = $this->productRepository->update([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'category_id' => $data['category_id'],
                    'selling_price' => $data['selling_price'],
                    'cost_price' => $data['cost_price'],
                    'crossed_price' => $data['crossed_price'],
                    'quantity' => $data['quantity'] ?? 0,
                    'sku' => $data['sku'],
                    'status' => $data['status'],
                ], $data['id']);
                $product->options()->delete();
                $product->variants()->delete();
                $product->product_images()->delete();
            } else {
                $product = $this->productRepository->create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'category_id' => $data['category_id'],
                    'selling_price' => $data['selling_price'],
                    'cost_price' => $data['cost_price'],
                    'crossed_price' => $data['crossed_price'],
                    'quantity' => $data['quantity'] ?? 0,
                    'sku' => $data['sku'],
                    'status' => $data['status'],
                ]);
            }

            $product->options()->createMany($data['options']);

            $productVariants = $product->variants()->createMany($data['variants']);

            
            foreach ($data['images'] as $image) {
                $uploadedImage = ImageService::uploadImage($image["image"], 'products');
                $product->product_images()->create([
                    'image' => $uploadedImage,
                    'variant_id' => ($image["variant"]) ? $productVariants->where('name', $image["variant"])->where('product_id', $product->id)->first()?->id : null,
                ]);
            }

            return $product->load('options', 'variants', 'product_images');
        });
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }
}
