<?php

use App\Container;
use App\Controller\HomeController;
use App\Controller\PublicationController;
use App\Controller\SecurityController;
use App\Controller\UserController;
use App\Middleware\UsersMiddleware;
use Config\Routing;

require_once '../vendor/altorouter/altorouter/AltoRouter.php';

$container = new Container();
$router = Routing::get();
$middleware = new UsersMiddleware();

// Routes pour le dashboard
$router->map('GET', '/', function () use ($container, $middleware) {
     $middleware->redirect();
     $container->getController(HomeController::class)->index();
}, name:"home");
// Routes pour le dashboard

// Routes pour les publications (administrateurs)

$router->map('GET', '/publications', function () use ($container) {
     $container->getController(PublicationController::class)->index($_GET);
}, "publication.index");

$router->map('GET', '/publications/create', function () use ($container) {
     $container->getController(PublicationController::class)->create($_GET);
}, "publication.create");

$router->map('POST', '/publications/create', function () use ($container) {
     $container->getController(PublicationController::class)->insert($_POST, $_FILES);
}, "publication.store");

$router->map('GET', '/publications/[i:id]/edit', function ($id) use ($container) {
     $container->getController(PublicationController::class)->edit($id);
}, "publication.edit");

$router->map('POST', '/publications/[i:id]/edit', function ($id) use ($container) {
     $container->getController(PublicationController::class)->update($id, $_POST, $_FILES);
}, "publication.update");

$router->map('POST', '/publications/[i:id]', function ($id) use ($container) {
     $container->getController(PublicationController::class)->delete($id);
}, "publication.delete");

// Routes pour les publications (administrateurs)

$router->map('GET', '/login', function () use ($container, $middleware) {
     $middleware->redirect();
     $container->getController(SecurityController::class)->loginView();
}, 'loginView');

$router->map('POST', '/login', function () use ($container, $middleware) {
     $middleware->redirect();
     $container->getController(SecurityController::class)->login($_POST);
}, "login");

$router->map('POST', '/logout', function () use ($container, $middleware) {
     $middleware->redirect();
     $container->getController(SecurityController::class)->logout();
}, "logout");

$router->map('GET', '/users', function () use ($container, $middleware) {
     $container->getController(UserController::class)->index($_GET);
}, "users.index");

$router->map('GET', '/users/registration', function () use ($container, $middleware) {
     $container->getController(UserController::class)->registration($_GET);
}, "users.register");

$router->map('POST', '/users/registration', function () use ($container, $middleware) {
     $container->getController(UserController::class)->register($_POST, $_FILES);
}, "users.store");

$router->map('GET', '/users/[i:id]', function ($id) use ($container, $middleware) {
     $container->getController(UserController::class)->profil($id);
}, "users.find");

$router->map('POST', '/users/[i:id]', function ($id) use ($container, $middleware) {
     $container->getController(UserController::class)->delete($id);
}, "users.delete");

$router->map('GET', '/users/edit', function () use ($container, $middleware) {
     $container->getController(UserController::class)->edit();
}, "users.edit");

$router->map('POST', '/users/edit', function () use ($container, $middleware) {
     $container->getController(UserController::class)->update($_POST, $_FILES);
}, "users.update");


$match = $router->match();
if ($match !== null) {     
     if (is_callable($match['target'])) {
          call_user_func_array($match['target'], $match['params']);
     }
}