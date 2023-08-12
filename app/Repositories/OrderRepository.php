<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
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
}
