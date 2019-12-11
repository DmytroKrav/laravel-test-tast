<?php

namespace App\Http\Requests\Api\V1\Chat;

use App\Http\Requests\Api\V1\BaseRequest;

class AllMessageFromRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'sender_id' => 'required|integer',
        ];
    }
}