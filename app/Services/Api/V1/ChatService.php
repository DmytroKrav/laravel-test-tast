<?php

declare(strict_types=1);

namespace App\Services\Api\V1;

use App\Http\Dto\MessageDto;
use App\Http\Entities\UsersMessages;
use App\Http\Repositories\UsersMessagesRepository;
use App\Http\Requests\Api\V1\Chat\NewMessageRequest;
use App\Http\Resources\Api\V1\Chat\MessagesCollection;
use Illuminate\Support\Facades\Auth;

class ChatService
{
    private $repository;

    public function __construct(UsersMessagesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function sendMessage(NewMessageRequest $request): ?UsersMessages
    {
        $messageDto = new MessageDto();
        $messageDto->sender_id = Auth::user()->getAuthIdentifier();
        $messageDto->load($request->all());

        return $this->repository->createMessage($messageDto);
    }

    public function getAllMessagesFrom(int $sender_id): MessagesCollection
    {
        $data = $this->repository->getAllMessagesFrom($sender_id);

        return new MessagesCollection($data);
    }

}