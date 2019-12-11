<?php

declare(strict_types=1);

namespace App\Services\Api\V1;

use App\Http\Dto\UserDto;
use App\Http\Entities\User\Users;
use App\Http\Requests\Api\V1\Auth\{ SignInRequest, SignUpRequest };
use App\Http\Repositories\UserRepository;
use App\Http\Resources\Api\V1\User\{ SignInResource, SignUpResource };
use Illuminate\Support\Facades\{ Auth, Hash };
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\{ HttpException, UnprocessableEntityHttpException };
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function singUp(SignUpRequest $request): SignUpResource
    {
        $userData = new UserDto();
        $userData->load($request->all());
        $userData->password = \Hash::make($userData->password);
        if ($savedUser = $this->repository->createUser($userData)) {
            $token = JWTAuth::fromUser($savedUser);
            $userData->accessTokenData = $this->withAccessTokenData($token);
            $savedUser->refresh_token = $this->getRefreshToken($savedUser);
            $this->repository->save($savedUser);

            $userData->load($savedUser->getAttributes());

            return new SignUpResource($userData);
        }

        throw new HttpException(500, 'Something is wrong, please try again later');
    }

    private function getRefreshToken(Users $user): string
    {
        JWTAuth::factory()->setTTL(env('REFRESH_LIFETIME'));

        return JWTAuth::fromUser($user);
    }

    public function signIn(SignInRequest $request): SignInResource
    {
        $userData = new UserDto();
        $userData->load($request->all());

        $user = $this->repository->findByEmail($userData->email);

        if (!$user) {
            throw new UnprocessableEntityHttpException('Email or password is invalid');
        }

        if (!Hash::check($userData->password, $user->password)) {
            throw new UnprocessableEntityHttpException('Email or password is invalid');
        }

        $token = JWTAuth::fromUser($user);
        $userData->refresh_token = $this->getRefreshToken($user);


        $user->refresh_token = $userData->refresh_token;
        if ($this->repository->save($user)) {
            $userData->accessTokenData = $this->withAccessTokenData($token);

            return new SignInResource($userData);
        }

        throw new HttpException(500, 'Something is wrong, please try again later');
    }

    public function getNewAccessTokenByRefresh(): SignInResource
    {
        $refreshToken = JWTAuth::getToken();
        $user = $this->repository->findByRefreshToken((string) $refreshToken);

        if (!$user) {
            throw new HttpException(401, 'Invalid refresh token');
        }

        $accessToken = JWTAuth::fromUser($user);
        $user->refresh_token = $this->getRefreshToken($user);

        if ($this->repository->save($user)) {
            $userData = new UserDto();
            $userData->load($user->getAttributes());
            $userData->accessTokenData = $this->withAccessTokenData($accessToken);

            return new SignInResource($userData);
        }
    }

    public function withAccessTokenData($token): array
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