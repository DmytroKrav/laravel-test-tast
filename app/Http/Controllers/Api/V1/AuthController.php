<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\{ SignInRequest, SignUpRequest };
use App\Http\Resources\Api\V1\User\{ SignInResource, SignUpResource };
use App\Services\Api\V1\AuthService;

class AuthController extends Controller
{
    private $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function signUp(SignUpRequest $request): SignUpResource
    {
        return $this->service->singUp($request);
    }

    public function signIn(SignInRequest $request): SignInResource
    {
        return $this->service->signIn($request);
    }

    public function generateNewAccessToken(): SignInResource
    {
        return $this->service->getNewAccessTokenByRefresh();
    }
}