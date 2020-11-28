<?php

namespace src\Repository;

use src\Entities\Article;

class ArticlesArrayRepository implements ArticlesRepositoryInterface
{
    public function findArticles(): array
    {
        return [];
    }

    public function findArticleById(int $id): Article
    {
        return new Article();
    }
}
