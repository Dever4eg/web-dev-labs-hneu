<?php

namespace src\Actions;

use src\Repository\ArticlesRepositoryInterface;
use src\Repository\Dto\ArticleCreateDto;
use src\SessionAuthorizer;
use src\ViewRenderer;

class ArticleStoreAction
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

        $dto = new ArticleCreateDto($_POST['title'], $_POST['text'], $_POST['image_url']);

        if(!empty($errors = $this->validate($dto))) {
            $this->renderer->show('article-create', ['articleDto' => $dto, 'errors' => $errors]);
        }

        $this->articlesRepository->createNewArticle($dto);

        header('Location: /articles');
    }

    private function validate(ArticleCreateDto $dto): array
    {
        return [];
    }
}
