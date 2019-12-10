<?php

namespace App\Http\Entities\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserEntity
 * @package App\Http\Entities\User
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $refresh_token
 * @property string $email
 */
class UserEntity extends Model
{
    public $timestamps = true;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'password',
        'refresh_token',
        'email',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
    ];

    public function ownMessages()
    {
        return $this->hasMany('App\Entity\Chat\UserMessageEntity', 'sender_id', 'id');
    }

    public function receivedMessages()
    {
        return $this->hasMany('App\Entity\Chat\UserMessageEntity', 'sender_id', 'id');
    }
}