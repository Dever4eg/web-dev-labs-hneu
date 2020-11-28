<?php

namespace src\Actions;

use src\Repository\ArticlesRepositoryInterface;
use src\ViewRenderer;

class ArticleShowAction
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

    public function __invoke(int $id)
    {
        $article = $this->articlesRepository->findArticleById($id);
        $this->renderer->show('article', ['article' => $article]);
    }
}
