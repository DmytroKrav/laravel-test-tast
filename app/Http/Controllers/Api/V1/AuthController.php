<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\SignInRequest;
use App\Http\Requests\Api\V1\Auth\SignUpRequest;
use App\Http\Services\Api\V1\AuthService;

class AuthController extends Controller
{
    public $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function signUp(SignUpRequest $request)
    {
        return $this->service->singUp($request);
    }

    public function signIn(SignInRequest $request)
    {
        return $this->service->signIn($request);
    }
}