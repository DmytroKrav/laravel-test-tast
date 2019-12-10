<?php

namespace App\Http\Repositories\User;

use App\Http\Dto\UserDto;
use App\Http\Entities\User\UserEntity;

class UserRepository
{
    public function __construct(UserEntity $entity)
    {
        $this->entity = $entity;
    }

    public function createUser(UserDto $data): ?UserEntity
    {
        $this->entity->name = $data->name;
        $this->entity->password = $data->password;
        $this->entity->email = $data->email;
        $this->entity->refresh_token = $data->refreshToken;

        if ($this->entity->saveOrFail()) {
            return $this->entity;
        }

        return null;
    }

    public function findAllUserExcept(int $id)
    {
        return $this->entity::all()->except($id);
    }
}