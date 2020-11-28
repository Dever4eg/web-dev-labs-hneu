<?php

namespace src\Actions;

use src\Repository\ArticlesRepositoryInterface;
use src\ViewRenderer;

class ArticleListAction
{
    private ArticlesRepositoryInterface $articlesRepository;
    private ViewRenderer $renderer;

    public function __construct(
        ArticlesRepositoryInterface $articlesRepository,
        ViewRenderer $renderer
    ) {
        $this->articlesRepository = $articlesRepository;
        $this->renderer = $renderer;
    }

    public function __invoke()
    {
        $articles = $this->articlesRepository->findArticles();
        $this->renderer->show('articles', ['articles' => $articles]);
    }
}
