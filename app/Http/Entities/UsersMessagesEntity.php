<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class UsersMessagesEntity extends Model
{
    const UPDATED_AT = null;

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