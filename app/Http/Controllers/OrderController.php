<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Libs\ApiResponse;
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
}
