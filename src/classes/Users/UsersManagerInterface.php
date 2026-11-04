<?php

namespace Users;


interface UsersManagerInterface {
    public function getUserById(int $id): ?User;

    public function getUserByEmail(string $email): ?User;

    public function getUserByShareCode(string $shareCode): ?User;

    public function emailExists(string $email): bool;

    public function pseudoExists(string $pseudo): bool;

    public function createUser(User $user): int;

    public function saveResult(User $user, int $hihiId): void;
}
