<?php

namespace App\Observers;

use App\Models\ProductImage;
use App\Services\ImageService;

class ProductImageObserver
{
    public function deleting(ProductImage $productImage): void
    {
        ImageService::deleteImage($productImage->image);
    }
}
