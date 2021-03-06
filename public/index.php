<?php

use src\Actions\ArticleCreateAction;
use src\Actions\ArticleListAction;
use src\Actions\ArticleShowAction;
use src\Actions\ArticleStoreAction;
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

try {
    $pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
} catch (Throwable $throwable) {
    echo 'Database connection error: ' . $throwable->getMessage();
    die;
}

$renderer = new ViewRenderer(__DIR__ . '/../templates/', 'layout');
$articleRepository = new ArticlesDatabaseRepository($pdo);
$userRepository = new UserArrayRepository();
$authorizer = new SessionAuthorizer($userRepository);

$listArticleAction = new ArticleListAction($articleRepository, $renderer);
$showArticleAction = new ArticleShowAction($articleRepository, $renderer);
$meAction = new MeAction($renderer, $authorizer);
$signInPageAction = new SignInPageAction($renderer);
$signInAction = new SignInAction($renderer, $authorizer, $userRepository);
$articleCreateAction = new ArticleCreateAction($articleRepository, $renderer, $authorizer);
$articleStoreAction = new ArticleStoreAction($articleRepository, $renderer, $authorizer);

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
    case '/articles' == $path && $method == 'GET':
        $listArticleAction();
        break;
    case '/articles' == $path && $method == 'POST':
        $articleStoreAction();
        break;
    case '/articles/create' == $path && $method == 'GET':
        $articleCreateAction();
        break;
    case '/' == $path:
        header('Location: /articles');
        break;
    default:
        echo '404 Not found';
        break;
}
