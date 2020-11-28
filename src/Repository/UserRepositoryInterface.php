<?php

namespace src\Repository;

use src\Entities\User;

interface UserRepositoryInterface
{
    public function findUserById(int $id): ?User;
    public function findByUsernameAndPassword(string $username, string $passwordHash): ?User;
}
