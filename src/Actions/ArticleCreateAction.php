<?php

namespace src\Actions;

use src\Repository\ArticlesRepositoryInterface;
use src\Repository\Dto\ArticleCreateDto;
use src\SessionAuthorizer;
use src\ViewRenderer;

class ArticleCreateAction
{
    private ArticlesRepositoryInterface $articlesRepository;

    private ViewRenderer $renderer;

    private SessionAuthorizer $authorizer;

    public function __construct(
        ArticlesRepositoryInterface $articlesRepository,
        ViewRenderer $renderer,
        SessionAuthorizer $authorizer
    ) {
        $this->articlesRepository = $articlesRepository;
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

        $dto = new ArticleCreateDto(null, null, null);
        $this->renderer->show('article-create', ['articleDto' => $dto]);
    }
}
