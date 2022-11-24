<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtuctOptionUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OptionResource;
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
     * Возвращает все продукты
     * @return Response|Application|ResponseFactory
     */
    public function info(): Response|Application|ResponseFactory
    {
        return ResponseService::success(ProductResource::collection(Product::all()));
    }

    /**
     * Возвращает категорию с которой связан продукт
     * @param Product $product
     * @return Response|Application|ResponseFactory
     */
    public function categoryInfo(Product $product): Response|Application|ResponseFactory
    {
        return ResponseService::success(CategoryResource::make($product->category));
    }

    /**
     * Возвращает какой-либо продукте
     * @param Product $product
     * @return Response|Application|ResponseFactory
     */
    public function infoOne(Product $product): Response|Application|ResponseFactory
    {
        return ResponseService::success(ProductResource::make($product));
    }

    /**
     * Возвращает список опций продукта
     * @param Product $product
     * @return Response|Application|ResponseFactory
     */
    public function optionInfo(Product $product): Response|Application|ResponseFactory
    {
        return ResponseService::success(OptionResource::collection($product->productOption->options));
    }
}
