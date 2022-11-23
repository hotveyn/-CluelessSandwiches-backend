<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ResponseService;
use App\Services\UserTokenService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        if (auth()->attempt($request->validated())) {
            $user = auth()->user();
            $user->api_token = UserTokenService::generate();
            $user->save();

            return ResponseService::success([
                "token" => UserResource::make($user)
            ]);
        }
        return ResponseService::error('Unauthorized', 401, [
            "phone" => ["phone or password incorrect"]
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        User::create($request->validated());
        return ResponseService::noContent();
    }

    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user();
        $user->password = $request->password;
        $user->name = $request->name;
        $user->email = $request->email;
        return response($user->name);
    }

//    public function info(UserStoreRequest $request){
//        User::create($request->validated());
//        return ResponseService::noContent();
//    }
}
