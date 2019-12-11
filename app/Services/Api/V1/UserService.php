<?php

declare(strict_types=1);

namespace App\Services\Api\V1;

use App\Http\Repositories\UserRepository;
use App\Http\Resources\Api\V1\User\UsersCollection;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllOtherUsers()
    {
        $currentUserId = Auth::user()->getAuthIdentifier();
        $allOtherUsers = $this->repository->findAllUserExcept($currentUserId);

        return new UsersCollection($allOtherUsers);
    }

}