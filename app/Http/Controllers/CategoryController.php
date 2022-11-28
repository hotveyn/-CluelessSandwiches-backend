<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @return Response|Application|ResponseFactory
     */
    function info(): Response|Application|ResponseFactory
    {
        return response(Category::all());
    }
    function infoOne(Category $category): Response|Application|ResponseFactory
    {
        return response(ProductResource::collection($category->products));
    }

}
