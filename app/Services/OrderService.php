<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Jobs\OrderPlacedJob;
use App\Models\OrderProduct;
use App\Repositories\OrderRepository;

class OrderService extends BaseService
{
    protected $orderRepository;
    protected $productService;
    protected $storeService;

    public function __construct(OrderRepository $orderRepository, ProductService $productService, StoreService $storeService)
    {
        $this->orderRepository = $orderRepository;
        $this->productService = $productService;
        $this->storeService = $storeService;
    }

    public function createOrder($data)
    {
        return $this->withTransaction(function () use ($data) {
            $products = [];
            foreach ($data['products'] as $product) {
                $item = $this->productService->getProduct($product['id']);
                $products[] = [
                    'product' => new ProductResource($item),
                    'variant' => $variant = !empty($product['variant_id']) ? $item->variants?->where('id', $product['variant_id'])->first() ?? null : null,
                    'quantity' => $quantity = $product['quantity'],
                    'price' => ($variant ? $variant->selling_price : $item->selling_price) * $quantity,
                ];
            }
            $data['products'] = $products;

            $data['order_number'] = 1000 + $this->orderRepository->count();

            $storeId = tenant('store_id');
            $data['delivery_charge'] = tenancy()->central(function () use ($storeId) {
                return $this->storeService->getStoreById($storeId)->setting?->delivery_charge ?? 0;
            });

            $data['total_price'] = collect($products)->sum('price') + $data['delivery_charge'];
            $data['total_quantity'] = collect($products)->sum('quantity');

            $order = $this->orderRepository->create($data);

            foreach ($products as $product) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product']->id,
                    'variant_id' => $product['variant']?->id,
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                ]);
            }

            dispatch(new OrderPlacedJob($order));

            return [
                "quantity" => $data['total_quantity'],
                "price" => $data['total_price'],
            ];
        });
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    public function updateOrder($data, $order)
    {
        return $this->orderRepository->update($data, $order);
    }

    public function getTrendingProducts($from = null, $to = null)
    {
        return $this->orderRepository->getMostOrderedProductsBetween($from, $to);
    }
}
