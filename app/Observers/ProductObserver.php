<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\ImageService;

class ProductObserver
{
    public function deleting(Product $product): void
    {
        $images = $product->product_images;

        foreach ($images as $image) {
            ImageService::deleteImage($image->image);
        }
    }
}
