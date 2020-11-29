<?php

namespace src\Repository;

use PDO;
use src\Entities\Article;

class ArticlesDatabaseRepository implements ArticlesRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return Article[]
     */
    public function findArticles(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM articles');

        return array_map(
            fn (array $article) => (new Article())
                ->setId($article['id'])
                ->setTitle($article['title'])
                ->setImage($article['image_url'])
                ->setText($article['text']),
            $stmt->fetchAll()
        );
    }

    public function findArticleById(int $id): ?Article
    {
        $stmt = $this->pdo->prepare('SELECT * FROM articles where id = ?');
        $stmt->execute([$id]);
        $article = $stmt->fetch();

        return (new Article())
            ->setId($article['id'])
            ->setTitle($article['title'])
            ->setImage($article['image_url'])
            ->setText($article['text']);
    }
}
