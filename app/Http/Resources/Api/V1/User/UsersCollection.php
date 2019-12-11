<?php

namespace App\Http\Resources\Api\V1\User;

use App\Http\Entities\User\Users;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->resource->transform(function (Users $item) use ($request) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                ];
            })
        ];
    }
}