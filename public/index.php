<?php

use src\Actions\ListArticleAction;
use src\Actions\ShowArticleAction;
use src\Repository\ArticlesArrayRepository;
use src\ViewRenderer;

require_once __DIR__ . '/../vendor/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$renderer = new ViewRenderer(__DIR__ . '/../templates/', 'layout');
$articleRepository = new ArticlesArrayRepository();

$listArticleAction = new ListArticleAction($articleRepository, $renderer);
$showArticleAction = new ShowArticleAction($articleRepository, $renderer);

switch (true) {
    case preg_match('~/articles/(\d+)~', $path, $matches):
        $id = (int) $matches[1];
        $showArticleAction($id);
        break;
    default:
        $listArticleAction();
        break;
}
