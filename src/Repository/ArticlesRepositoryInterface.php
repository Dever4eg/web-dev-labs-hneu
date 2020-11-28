<?php

namespace src\Repository;

use src\Entities\Article;

interface ArticlesRepositoryInterface
{
    /**
     * @return Article[]
     */
    public function findArticles(): array;

    /**
     * @param int $id
     * @return Article|null
     */
    public function findArticleById(int $id): ?Article;
}
