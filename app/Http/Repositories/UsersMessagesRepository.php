<?php

namespace App\Http\Repositories;

use App\Http\Dto\MessageDto;
use App\Http\Entities\UsersMessages;
use Illuminate\Support\Facades\Auth;

class UsersMessagesRepository
{
    private $entity;

    public function __construct(UsersMessages $entity)
    {
        $this->entity = $entity;
    }

    public function createMessage(MessageDto $data): ?UsersMessages
    {
        return $this->entity->create([
            'message' => $data->message,
            'receiver_id' => $data->receiver_id,
            'sender_id' => $data->sender_id,

        ]);
    }

    public function getAllMessagesFrom(int $senderId)
    {
        return $this->entity->where('sender_id', $senderId)
            ->orderBy('created_at', 'desc')
            ->where('receiver_id', Auth::user()->getAuthIdentifier())
            ->get();
    }

}