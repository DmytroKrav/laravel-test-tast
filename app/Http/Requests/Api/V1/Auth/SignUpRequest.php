<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\V1\BaseRequest;

class SignUpRequest extends BaseRequest
{
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'name' => 'required',
                'email' => ['required', 'email'],
                'password' => ['numeric', 'required'],
                'repeat_password' => ['numeric', 'required', 'same:password'],
            ];
        }
    }
}