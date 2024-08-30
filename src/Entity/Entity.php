<?php

namespace App\Entity;

use Config\DataBase;

class Entity 
{

     public function __construct (protected DataBase $db)
     {
          if (session_status() == PHP_SESSION_NONE) session_start();
     }

}


?>