<?php

namespace App\Http\Entities\User;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class UserEntity
 * @package App\Http\Entities\User
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $refresh_token
 * @property string $email
 */
class Users extends Model implements JWTSubject
{
    public $timestamps = true;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'password',
        'refresh_token',
        'email',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}