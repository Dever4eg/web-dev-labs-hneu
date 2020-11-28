<?php

namespace src\Actions;

use src\Repository\UserRepositoryInterface;
use src\SessionAuthorizer;
use src\ViewRenderer;

class SignInAction
{
    private ViewRenderer $renderer;
    private SessionAuthorizer $authorizer;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        ViewRenderer $renderer,
        SessionAuthorizer $authorizer,
        UserRepositoryInterface $userRepository
    ) {
        $this->renderer = $renderer;
        $this->authorizer = $authorizer;
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!$username or !$password) {
            $this->renderer->show('signin', [
                'username' => $username,
                'password' => $password,
                'error' => 'Please fill a credentials'
            ]);
            return;
        }

        // md5 is not secure, I know it
        $passwordHash = md5($password);
        $user = $this->userRepository->findByUsernameAndPassword($username, $passwordHash);

        if (null == $user) {
            $this->renderer->show('signin', [
                'username' => $username,
                'password' => $password,
                'error' => 'Wrong credentials'
            ]);
            return;
        }

        $this->authorizer->authorize($user);

        header('Location: /me');
    }
}
