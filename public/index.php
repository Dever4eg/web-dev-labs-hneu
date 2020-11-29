<?php

use src\Actions\ArticleListAction;
use src\Actions\ArticleShowAction;
use src\Actions\MeAction;
use src\Actions\SignInAction;
use src\Actions\SignInPageAction;
use src\Repository\ArticlesDatabaseRepository;
use src\Repository\UserArrayRepository;
use src\SessionAuthorizer;
use src\ViewRenderer;

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../config/config.php';

$dsn = sprintf(
    '%s:host=%s;dbname=%s;charset=%s',
    $config['database']['driver'],
    $config['database']['host'],
    $config['database']['name'],
    $config['database']['charset']
);
$pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);

$renderer = new ViewRenderer(__DIR__ . '/../templates/', 'layout');
$articleRepository = new ArticlesDatabaseRepository($pdo);
$userRepository = new UserArrayRepository();
$authorizer = new SessionAuthorizer($userRepository);

$listArticleAction = new ArticleListAction($articleRepository, $renderer);
$showArticleAction = new ArticleShowAction($articleRepository, $renderer);
$meAction = new MeAction($renderer, $authorizer);
$signInPageAction = new SignInPageAction($renderer);
$signInAction = new SignInAction($renderer, $authorizer, $userRepository);

$renderer->addOptions([
    'user' => $authorizer->getAuthorizedUser()
]);

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

switch (true) {
    case preg_match('~/articles/(\d+)~', $path, $matches):
        $id = (int) $matches[1];
        $showArticleAction($id);
        break;
    case '/me' == $path:
        $meAction();
        break;
    case '/signin' == $path && $method == 'GET':
        $signInPageAction();
        break;
    case '/signin' == $path && $method == 'POST':
        $signInAction();
        break;
    default:
        $listArticleAction();
        break;
}
