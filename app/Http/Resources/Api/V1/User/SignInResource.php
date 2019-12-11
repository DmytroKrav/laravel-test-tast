<?php

namespace App\Http\Resources\Api\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class SignInResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'refresh_token' => $this->refresh_token,
            'access_token' => $this->accessTokenData['access_token'],
            'expires_in' => $this->accessTokenData['expires_in'],
            'token_type' => $this->accessTokenData['token_type']
        ];
    }
}