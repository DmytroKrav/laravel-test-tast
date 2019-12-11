<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersMessages
 * @package App\Http\Entities
 * @property string $message
 * @property integer sender_id
 * @property integer receiver_id
 * @property string $created_at
 */
class UsersMessages extends Model
{
    const UPDATED_AT = null;

    protected $dateFormat = 'U';

    public $timestamps = true;

    protected $table = 'users_messages';

    protected $casts = [
        'created_at' => 'timestamp',
    ];
    protected $fillable = [
        'receiver_id',
        'sender_id',
        'message',
    ];

}