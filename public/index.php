<?php

use src\Actions\ArticleListAction;
use src\Actions\ArticleShowAction;
use src\Actions\MeAction;
use src\Repository\ArticlesArrayRepository;
use src\Repository\UserArrayRepository;
use src\SessionAuthorizer;
use src\ViewRenderer;

require_once __DIR__ . '/../vendor/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$renderer = new ViewRenderer(__DIR__ . '/../templates/', 'layout');
$articleRepository = new ArticlesArrayRepository();
$userRepository = new UserArrayRepository();
$authorizer = new SessionAuthorizer($userRepository);

$listArticleAction = new ArticleListAction($articleRepository, $renderer);
$showArticleAction = new ArticleShowAction($articleRepository, $renderer);
$meAction = new MeAction($renderer, $authorizer);

switch (true) {
    case preg_match('~/articles/(\d+)~', $path, $matches):
        $id = (int) $matches[1];
        $showArticleAction($id);
        break;
    case '/me' == $path:
        $meAction();
        break;
    default:
        $listArticleAction();
        break;
}
