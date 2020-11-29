<?php

namespace src\Repository;

use src\Entities\Article;
use src\Repository\Dto\ArticleCreateDto;

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

    public function createNewArticle(ArticleCreateDto $dto): bool;
}
