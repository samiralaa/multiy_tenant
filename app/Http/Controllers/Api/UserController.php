<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public  function index()
    {
        return $this->userService->getAll();
    }

    public function show($id)
    {
        return $this->userService->getOne($id);
    }

    public function store(CreateUserRequest $request)
    {
        return $this->userService->create($request->all());
    }
}
