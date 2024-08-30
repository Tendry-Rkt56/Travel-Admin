<?php

namespace App;

use AltoRouter;

class Container 
{

     public function getController (string $controller)
     {
          return new $controller(new AltoRouter());
     }

}