<?php

namespace App;

use AltoRouter;

class Container 
{
     
     /**
      * @param string $controller
      */
     public function getController (string $controller)
     {
          return new $controller(new AltoRouter());
     }

}