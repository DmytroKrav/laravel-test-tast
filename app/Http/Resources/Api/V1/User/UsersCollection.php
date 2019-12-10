<?php

namespace App\Http\Resources\Api\V1\User;

use App\Http\Entities\User\UserEntity;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->resource->transform(function (UserEntity $item) use ($request) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'created_at' => $item->created_at,
                ];
            })
        ];
    }
}