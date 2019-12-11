<?php

namespace App\Http\Repositories;

use App\Http\Dto\UserDto;
use App\Http\Entities\User\Users;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    private $userEntity;

    public function __construct(Users $userEntity)
    {
        $this->userEntity = $userEntity;
    }

    public function createUser(UserDto $data): ?Users
    {
        return $this->userEntity->create([
            'name' => $data->name,
            'password' => $data->password,
            'email' => $data->email,
        ]);
    }

    public function findAllUserExcept(int $id): Collection
    {
        return $this->userEntity->all()->except($id);
    }

    public function save(Users $userEntity): bool
    {
        return $userEntity->save();
    }


    public function findByEmail(string $email): ?Users
    {
        return $this->userEntity->where('email', $email)->first();
    }

    public function findByRefreshToken(string $refreshToken): ?Users
    {
        return $this->userEntity->where('refresh_token', $refreshToken)->first();
    }
}