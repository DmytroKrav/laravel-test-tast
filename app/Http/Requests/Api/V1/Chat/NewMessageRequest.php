<?php

namespace App\Http\Requests\Api\V1\Chat;

use App\Http\Requests\Api\V1\BaseRequest;

class NewMessageRequest extends BaseRequest
{
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'message' => ['required', 'string'],
                'receiver_id' => ['numeric', 'required'],
            ];
        }
    }
}