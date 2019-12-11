<?php

namespace App\Http\Dto;

/**
 * Class MessageDto
 * @property string $message
 * @property string $receiver_id
 * @property string $sender_id
 * @property string $created_at
 */
class MessageDto extends BaseDto
{
    public $message;

    public $receiver_id;

    public $sender_id;

    public $created_at;
}