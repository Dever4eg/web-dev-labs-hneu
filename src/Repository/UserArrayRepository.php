<?php

namespace src\Repository;

use src\Entities\User;

class UserArrayRepository implements UserRepositoryInterface
{
    private array $users = [
        [
            'id' => 1,
            'username' => 'dever4eg',
            'passwordHash' => 'e10adc3949ba59abbe56e057f20f883e',
        ],
        [
            'id' => 2,
            'username' => 'alex',
            'passwordHash' => 'e10adc3949ba59abbe56e057f20f883e',
        ]
    ];

    public function findUserById(int $id): ?User
    {
        foreach ($this->users as $user) {
            if ($user['id'] === $id) {
                return (new User())
                    ->setId($user['id'])
                    ->setUsername($user['username'])
                    ->setPasswordHash($user['passwordHash']);
            }
        }

        return null;
    }

    public function findByUsernameAndPassword(string $username, string $passwordHash): ?User
    {
        foreach ($this->users as $user) {
            if ($user['username'] === $username && $user['passwordHash'] === $passwordHash) {
                return (new User())
                    ->setId($user['id'])
                    ->setUsername($user['username'])
                    ->setPasswordHash($user['passwordHash']);
            }
        }

        return null;
    }
}
