<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStatusRequest;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductOption;
use App\Models\Product;
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
     * Возвращает информацию по какому то из заказов
     * @param Order $order
     * @return Application|Response|ResponseFactory
     */
    public function infoOne(Order $order): Application|ResponseFactory|Response
    {
        return response(OrderResource::make($order));
    }

    /**
     * Возвращает все заказы
     * @return Response|Application|ResponseFactory
     */
    public function info(): Response|Application|ResponseFactory
    {
        return response(OrderResource::collection(Order::all()));
    }

    /**
     * Создаёт новый заказ
     * @param OrderStoreRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function store(OrderStoreRequest $request): Response|Application|ResponseFactory
    {
        $order = Order::create([
            //todo: хз как сделать чтобы он делал уникальный
            "code"=>fake()->unique()->numberBetween(1, 10000),
            "status_id"=>1,
        ]);
        //todo: Вынести в order_product (наверное)
        foreach ($request->products as $product){
            $orderProduct = OrderProduct::create([
                "order_id" => $order->id,
                "product_id"=> $product['product_id'],
                "count"=> $product['product_count']
            ]);

            foreach ($product->options as $option){
                OrderProductOption::create([
                    "name" => $option->name,
                    "toggle" => $option->toggle,
                    "order_product_id" => $orderProduct->id
                ]);
            }
        }
        return response(OrderResource::make($order));
    }
}
