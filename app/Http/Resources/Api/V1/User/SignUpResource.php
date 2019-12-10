<?php

namespace App\Http\Resources\Api\V1\User;

class SignUpResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'refresh_token' => $this->refresh_token,
            'access_token' => $this->accessTokenData['access_token'],
            'expires_in' => $this->accessTokenData['expires_in'],
            'token_type' => $this->accessTokenData['token_type']
        ];
    }
}