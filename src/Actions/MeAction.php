<?php

namespace src\Actions;

use src\SessionAuthorizer;
use src\ViewRenderer;

class MeAction
{
    private ViewRenderer $renderer;
    private SessionAuthorizer $authorizer;

    public function __construct(
        ViewRenderer $renderer,
        SessionAuthorizer $authorizer
    ) {
        $this->renderer = $renderer;
        $this->authorizer = $authorizer;
    }

    public function __invoke()
    {
        $user = $this->authorizer->getAuthorizedUser();
        if (null == $user) {
            $this->renderer->show('unauthorized');
            return;
        }

        $this->renderer->show('me', ['user' => $user]);
    }
}
