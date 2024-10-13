<?php

namespace App\Controller;

use App\Manager;
use Config\Routing;

require_once '../vendor/altorouter/altorouter/AltoRouter.php';
 

class Controller 
{    

     private $router;
     protected $manager;

     public function __construct()
     {
          $this->manager = Manager::getManager();
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

     protected function json (mixed $data = [])
     {
          echo json_encode($data);
          header('Content-Type: application/json');
     }

}