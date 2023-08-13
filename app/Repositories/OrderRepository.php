<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderRepository
{
    protected $order;
    protected $orderProduct;

    public function __construct(Order $order, OrderProduct $orderProduct)
    {
        $this->order = $order;
        $this->orderProduct = $orderProduct;
    }

    public function count()
    {
        return $this->order->count();
    }

    public function create(array $data)
    {
        return $this->order->create($data);
    }

    public function getAllOrders()
    {
        return $this->order->all();
    }

    public function update(array $data, Order $order)
    {
        $order->update($data);

        return $order;
    }

    public function getMostOrderedProductsBetween($from, $to)
    {
        $orderProducts =  $this->orderProduct->with('product');

        if ($from && $to) {
            $orderProducts = $orderProducts->whereBetween('created_at', [$from, $to]);
        }

        return $orderProducts->get()->groupBy('product_id')->map(function ($item) {
            return [
                'product' => new ProductResource($item->first()->product),
                'quantity' => $item->sum('quantity'),
                'price' => $item->sum('price'),
            ];
        })->sortByDesc('quantity')->values()->take(10);
    }
}
