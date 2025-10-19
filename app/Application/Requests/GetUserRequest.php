<?php

namespace App\Application\Requests;

class GetUserRequest
{
    public function __construct(
        public readonly int $userId
    ) {}
}
