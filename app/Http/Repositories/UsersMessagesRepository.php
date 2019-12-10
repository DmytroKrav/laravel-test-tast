<?php

namespace App\Http\Repositories;

use App\Http\Dto\MessageDto;
use App\Http\Entities\UsersMessagesEntity;
use Illuminate\Support\Facades\Auth;

class UsersMessagesRepository
{
    public function __construct(UsersMessagesEntity $entity)
    {
        $this->entity = $entity;
    }

    public function createMessage(MessageDto $data): ?UsersMessagesEntity
    {
        $this->entity->message = $data->message;
        $this->entity->receiver_id = $data->receiver_id;
        $this->entity->sender_id = $data->sender_id;

        if ($this->entity->saveOrFail()) {
            return $this->entity;
        }

        return null;
    }

    public function getAllMessagesFrom(int $senderId)
    {
        return $this->entity::where('sender_id', $senderId)
            ->orderBy('created_at', 'desc')
            ->where('receiver_id', Auth::user()->getAuthIdentifier())
            ->get();
    }

}