<?php

namespace App\Controller;

use AltoRouter;
use Config\Routing;

require_once '../vendor/altorouter/altorouter/AltoRouter.php';
 

class Controller 
{    

     private $router;

     public function __construct()
     {
          $this->router = Routing::get();
          if (session_status() == PHP_SESSION_NONE) session_start();
     }

     public function render(string $view, array $data = [], bool $html = false)
     {
          extract($data);
          $extension = $html ? ".html" : ".html.php";
          $vue = "../templates/".str_replace('.', '/', $view)."".$extension;
          require_once $vue;
     }

     public function redirect (string $route)
     {
          header('Location: '.$this->router->generate($route));
          exit;
     }

}