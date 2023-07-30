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
}
