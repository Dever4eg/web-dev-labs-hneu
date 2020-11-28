<?php

namespace src\Repository;

use src\Entities\User;

interface UserRepositoryInterface
{
    public function findUserById(int $id): ?User;
}
