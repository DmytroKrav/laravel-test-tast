<?php

namespace App\Http\Resources\Api\V1\Chat;

use App\Http\Entities\UsersMessages;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessagesCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->resource->transform(function (UsersMessages $item) use ($request) {
                return [
                    'sender_id' => $item->sender_id,
                    'message' => $item->message,
                    'created_at' => $item->created_at,
                ];
            })
        ];
    }
}