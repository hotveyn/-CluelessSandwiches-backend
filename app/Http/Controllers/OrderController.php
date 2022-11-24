<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Принимает id заказа в route
     * Меняет статус заказа
     * @param OrderStatusRequest $request
     * @param Order $order
     * @return Response|Application|ResponseFactory
     */
    public function update(OrderStatusRequest $request, Order $order): Response|Application|ResponseFactory
    {
        $order->update($request->validated());
        return ResponseService::success(
            $order,
            201
        );
    }

    /**
     * @param Order $order
     * @return Application|Response|ResponseFactory
     */
    public function info(Order $order): Application|ResponseFactory|Response
    {
        return response(OrderResource::make($order));
    }
}
