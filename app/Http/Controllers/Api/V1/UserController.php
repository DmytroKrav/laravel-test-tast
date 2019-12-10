<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\UserService;

class UserController extends Controller
{
    public $service;

    public function __construct(UserService $authService)
    {
        $this->service = $authService;
    }

    public function getAllOtherUsers()
    {
        return $this->service->getAllOtherUsers();
    }
}