<?php

namespace src\Actions;

use src\ViewRenderer;

class SignInPageAction
{
    private ViewRenderer $renderer;

    public function __construct(ViewRenderer $renderer) {
        $this->renderer = $renderer;
    }

    public function __invoke()
    {
        $this->renderer->show('signin');
    }
}
