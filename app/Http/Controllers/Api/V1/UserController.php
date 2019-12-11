<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\UsersCollection;
use App\Services\Api\V1\UserService;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $authService)
    {
        $this->service = $authService;
    }

    public function getAllOtherUsers(): UsersCollection
    {
        return $this->service->getAllOtherUsers();
    }
}