<?php

namespace App\Domain\Models;

class User
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $email_verified_at = null
    ) {}

    public function isEmailVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function withId(int $id): self
    {
        return new self(
            id: $id,
            name: $this->name,
            email: $this->email,
            email_verified_at: $this->email_verified_at
        );
    }
}
