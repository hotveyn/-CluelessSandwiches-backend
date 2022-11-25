<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionUpdateRequest;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use App\Models\Product;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OptionController extends Controller
{
    /**
     * Меняет значение toggle
     * @param OptionUpdateRequest $request
     * @param Option $option
     * @return Application|ResponseFactory|Response
     */
    public function update(OptionUpdateRequest $request, Option $option): Response|Application|ResponseFactory
    {
        $option->update($request->validated());
        return response()->noContent();
    }

    /**
     * Возвращает опцию
     * @param Option $option
     * @return Response|Application|ResponseFactory
     */
    public function info(Option $option): Response|Application|ResponseFactory
    {
        return ResponseService::success(OptionResource::make($option));
    }
}
