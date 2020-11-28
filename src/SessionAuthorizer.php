<?php

namespace src;

use src\Entities\User;
use src\Repository\UserRepositoryInterface;

class SessionAuthorizer
{
    const SESSION_KEY = 'user';

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User|null
     */
    public function getAuthorizedUser(): ?User
    {
        session_start();

        if (!array_key_exists(self::SESSION_KEY, $_SESSION)) {
            return null;
        }

        $id = $_SESSION[self::SESSION_KEY];

        return $this->userRepository->findUserById($id);
    }

    public function authorize(User $user): void
    {
        session_start();
        $_SESSION[self::SESSION_KEY] = $user->getIdentifier();
    }
}
