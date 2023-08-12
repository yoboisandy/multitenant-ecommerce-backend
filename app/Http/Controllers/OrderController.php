<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Libs\ApiResponse;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderService $orderService)
    {
    }

    public function createOrder(OrderRequest $request)
    {
        $data = $request->validated();
        return ApiResponse::success($this->orderService->createOrder($data), "Order placed  successfully.");
    }

    public function getAllOrders()
    {
        return ApiResponse::success(OrderResource::collection($this->orderService->getAllOrders()));
    }

    public function getOrderById(Order $order)
    {
        return ApiResponse::success(new OrderResource($order));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $data = $request->only(['order_status', 'payment_status']);
        return ApiResponse::success(new OrderResource($this->orderService->updateOrder($data, $order)), "Order updated successfully.");
    }
}
