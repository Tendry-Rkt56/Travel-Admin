<?php

use App\Container;
use App\Controller\PublicationController;
use App\Controller\UserController;
use Config\Routing;

require_once '../vendor/altorouter/altorouter/AltoRouter.php';

$container = new Container();

$router = Routing::get();

// Routes pour le dashboard
$router->map('GET', '/', function () use ($container) {
     $container->getController(UserController::class)->index();
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


$match = $router->match();
if ($match !== null) {     
     if (is_callable($match['target'])) {
          call_user_func_array($match['target'], $match['params']);
     }
}