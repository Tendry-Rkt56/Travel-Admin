<?php

use App\Container;
use App\Controller\CategoryController;
use App\Controller\GalleryController;
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
$router->map('GET', '/', function () use ($container) {
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

$router->map('GET', '/login', function () use ($container) {
     $container->getController(SecurityController::class)->loginView();
}, 'loginView');

$router->map('POST', '/login', function () use ($container) {
     $container->getController(SecurityController::class)->login($_POST);
}, "login");

$router->map('POST', '/logout', function () use ($container) {
     $container->getController(SecurityController::class)->logout();
}, "logout");

$router->map('GET', '/users', function () use ($container) {
     $container->getController(UserController::class)->index($_GET);
}, "users.index");

$router->map('GET', '/users/registration', function () use ($container) {
     $container->getController(UserController::class)->registration($_GET);
}, "users.register");

$router->map('POST', '/users/registration', function () use ($container) {
     $container->getController(UserController::class)->register($_POST, $_FILES);
}, "users.store");

$router->map('GET', '/users/[i:id]', function ($id) use ($container) {
     $container->getController(UserController::class)->profil($id);
}, "users.find");

$router->map('POST', '/users/[i:id]', function ($id) use ($container) {
     $container->getController(UserController::class)->delete($id);
}, "users.delete");

$router->map('GET', '/users/edit', function () use ($container) {
     $container->getController(UserController::class)->edit();
}, "users.edit");

$router->map('POST', '/users/edit', function () use ($container) {
     $container->getController(UserController::class)->update($_POST, $_FILES);
}, "users.update");

$router->map('GET', '/gallery', function () use ($container) {
     $container->getController(GalleryController::class)->index($_GET);
}, "gallery.index");

$router->map('GET', '/gallery/add', function () use ($container) {
     $container->getController(GalleryController::class)->create();
}, "gallery.add");

$router->map('POST', '/gallery/add', function () use ($container) {
     $container->getController(GalleryController::class)->add($_FILES);
});

$router->map('POST', '/gallery/[i:id]', function ($id) use ($container) {
     $container->getController(GalleryController::class)->delete($id);
});

// Routes pour les cateégories

$router->map('GET', '/category', function() use ($container) {
     $container->getController(CategoryController::class)->index($_GET);
}, name:'category.index');

$router->map('GET', '/category/new', function() use ($container) {
     $container->getController(CategoryController::class)->create();
}, name: 'category.create');

$router->map('POST', '/category/new', function() use ($container) {
     $container->getController(CategoryController::class)->store($_POST);
}, name: 'category.store');

$router->map('GET', '/category/edit-[i:id]', function($id) use ($container) {
     $container->getController(CategoryController::class)->edit($id);
}, name: 'category.edit');

$router->map('POST', '/category/edit-[i:id]', function($id) use ($container) {
     $container->getController(CategoryController::class)->update($id, $_POST);
}, name: 'category.update');

$router->map('POST', '/category/delete-[i:id]', function($id) use ($container) {
     $container->getController(CategoryController::class)->delete($id);
}, name: 'category.delete');

// Routes pour les cateégories


// Routes concernant les api

$router->map('GET', '/api/gallery/[i:id]', function ($id) use ($container) {
     $container->getController(GalleryController::class)->fetchApi($id);
});

// Routes concernant les api

$match = $router->match();
if ($match !== null) {     
     if (is_callable($match['target'])) {
          call_user_func_array($match['target'], $match['params']);
     }
}