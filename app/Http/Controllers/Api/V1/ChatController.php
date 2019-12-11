<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Chat\NewMessageRequest;
use App\Http\Resources\Api\V1\Chat\MessagesCollection;
use App\Services\Api\V1\ChatService;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller
{
    private $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function sendMessage(NewMessageRequest $request): JsonResponse
    {
        if ($this->chatService->sendMessage($request)) {
            return new JsonResponse(['message' => 'message was sent', 'statusCode' => 201], 201);
        }
    }

    public function getAllMessagesFrom(int $sender_id): MessagesCollection
    {
        return $this->chatService->getAllMessagesFrom($sender_id);
    }

}