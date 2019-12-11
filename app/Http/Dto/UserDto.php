<?php

namespace App\Http\Dto;

/**
 * Class UserSignUpData
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $refreshToken
 * @property string $email
 */
class UserDto extends BaseDto
{
    public $id;

    public $email;

    public $password;

    public $name;

    public $refresh_token = 'test';

    public $accessTokenData = [];

    public $created_at;
}