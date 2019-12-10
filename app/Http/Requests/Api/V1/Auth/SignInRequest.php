<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\V1\BaseRequest;

class SignInRequest extends BaseRequest
{
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'email' => ['required', 'email'],
                'password' => ['numeric', 'required'],
            ];
        }
    }
}