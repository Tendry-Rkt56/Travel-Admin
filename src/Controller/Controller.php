<?php

namespace App\Controller;

use App\Manager;
use Config\Routing;

require_once '../vendor/altorouter/altorouter/AltoRouter.php';
 

class Controller 
{    

     private $router;
     protected $manager;
     private $token;

     public function __construct()
     {
          $this->manager = Manager::getManager();
          $this->router = Routing::get();
          if (session_status() == PHP_SESSION_NONE) session_start();
          $_SESSION['token'] = bin2hex(random_bytes(32));
          $this->token = $_SESSION['token'];
     }

     protected function checkToken(array $data = [])
     {
          if (!isset($data['token']) && $data['token'] !== $this->token) {
               $errorContent = file_get_contents('../templates/error/error.html.php');
               $errorContent = str_replace(['404 NOT FOUND', 'Page introuvable'], ['UNAUTHORIZED', 'Cette action n\'est pas autorisée'], $errorContent);
               echo $errorContent;
               die;
          }
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