<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Eloquent\UserEloquent;

class UserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        $userEloquent = UserEloquent::find($id);
        return $userEloquent ? $this->toDomain($userEloquent) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $userEloquent = UserEloquent::where('email', $email)->first();
        return $userEloquent ? $this->toDomain($userEloquent) : null;
    }

    public function save(User $user): User
    {
        $userEloquent = new UserEloquent();
        $userEloquent->name = $user->name;
        $userEloquent->email = $user->email;
        $userEloquent->password = $user->password;
        $userEloquent->save();

        return $this->toDomain($userEloquent);
    }

    public function delete(int $id): bool
    {
        return UserEloquent::destroy($id) > 0;
    }

    public function findAll(): array
    {
        return UserEloquent::all()->map(fn($user) => $this->toDomain($user))->toArray();
    }

    private function toDomain(UserEloquent $userEloquent): User
    {
        return new User(
            id: $userEloquent->id,
            name: $userEloquent->name,
            email: $userEloquent->email,
            email_verified_at: $userEloquent->email_verified_at
        );
    }
}
