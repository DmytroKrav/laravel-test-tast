<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Chat\AllMessageFromRequest;
use App\Http\Requests\Api\V1\Chat\NewMessageRequest;
use App\Http\Services\Api\V1\ChatService;

class ChatController extends Controller
{
    public $service;

    public function __construct(ChatService $authService)
    {
        $this->service = $authService;
    }

    public function getAllMessages()
    {
        return 'dwawddw';
    }

    public function sendMessage(NewMessageRequest $request)
    {
        if ($this->service->sendMessage($request)) {
            return response()->json(['message' => 'message was sent', 'status' => 200]);
        }
    }

    public function getAllMessagesFrom(AllMessageFromRequest $request)
    {
        return $this->service->getAllMessagesFrom($request);
    }

}