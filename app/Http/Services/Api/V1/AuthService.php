<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Dto\UserDto;
use App\Http\Requests\Api\V1\Auth\SignInRequest;
use App\Http\Requests\Api\V1\Auth\SignUpRequest;
use App\Http\Repositories\User\UserRepository;
use App\Http\Resources\Api\V1\User\SignInResource;
use App\Http\Resources\Api\V1\User\SignUpResource;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function singUp(SignUpRequest $request)
    {
        $userData = new UserDto();
        $userData->load($request->all());
        $userData->password = \Hash::make($userData->password);
        $userData->refreshToken = \Hash::make($userData->password);

        if ($savedUser = $this->repository->createUser($userData)) {
            $token = $this->guard()->attempt($request->only(['email', 'password']));
            $userData->load($savedUser->getAttributes());
            $userData->accessTokenData = $this->withAccessToken($token);

            return new SignUpResource($userData);
        }
    }

    public function signIn(SignInRequest $request)
    {
        $userData = new UserDto();
        $token = $this->guard()->attempt($request->only(['email', 'password']));

        if ($token) {
            $userData->accessTokenData = $this->withAccessToken($token);

            return new SignInResource($userData);
        }
    }

    public function withAccessToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ];
    }

    private function guard()
    {
        return Auth::guard('api');
    }
}