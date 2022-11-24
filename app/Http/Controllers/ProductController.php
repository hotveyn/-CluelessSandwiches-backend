<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtuctOptionUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Option;
use App\Models\Product;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Принимает id продукта
     * Возвращает категорию с которой связан продукт
     * @param Product $product
     * @return Response|Application|ResponseFactory
     */
    public function categoryInfo(Product $product): Response|Application|ResponseFactory
    {
        return ResponseService::success(CategoryResource::collection($product->category()->get()));
    }

    /**
     * Принимает id продокута
     * Возвращает полною информацию о продукте
     * @param Product $product
     * @return Response|Application|ResponseFactory
     */
    public function info(Product $product): Response|Application|ResponseFactory
    {
        return ResponseService::success(ProductResource::make($product));
    }

    public function optionUpdate(ProtuctOptionUpdateRequest $request, Product $product, Option $option)
    {
        $option->update($request->validated());
        return response($option);
    }
}
