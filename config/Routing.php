<?php

namespace Config;

use AltoRouter;

class Routing 
{

     private static $router;

     public static function get ()
     {
          if (self::$router == null) self::$router = new AltoRouter();
          return self::$router;
     }

}