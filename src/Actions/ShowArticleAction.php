<?php

namespace src\Actions;

use src\Repository\ArticlesRepositoryInterface;
use src\ViewRenderer;

class ShowArticleAction
{
    /**
     * @var ArticlesRepositoryInterface
     */
    private $articlesRepository;

    /**
     * @var ViewRenderer
     */
    private $renderer;

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
