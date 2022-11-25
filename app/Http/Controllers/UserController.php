<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ResponseService;
use App\Services\UserTokenService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Принимает phone, password
     * Авторизует юзера, отдаёт токен
     * @param UserLoginRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function login(UserLoginRequest $request): Response|Application|ResponseFactory
    {
        if (auth()->attempt($request->validated())) {
            $user = auth()->user();
            $user->api_token = UserTokenService::generate();
            $user->save();

            return response([
                "token" => UserResource::make($user)
            ]);
        }
        return ResponseService::error('Unauthorized', 401, [
            "phone" => ["phone or password incorrect"]
        ]);
    }

    /**
     * Создаёт нового пользователя
     * @param UserStoreRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function store(UserStoreRequest $request): Response|Application|ResponseFactory
    {
        User::create($request->validated());
        return response()->noContent();
    }

    /**
     * Принимает password, name, email
     * Изменяет переданные значения авторизированного пользователя
     * @param UserUpdateRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function update(UserUpdateRequest $request): Response|Application|ResponseFactory
    {
        $user = auth()->user();

        // todo: Переписать
        if ($request->has('phone')) {
            $user->password = $request->password;
        }
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }

        return response($user);
    }

//    public function info(UserStoreRequest $request){
//        User::create($request->validated());
//        return ResponseService::noContent();
//    }
}
