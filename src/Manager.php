<?php

namespace App;

use Config\DataBase;

class Manager 
{

     private static $_instance;
     private static $_db;

     public static function getManager () 
     {
          if (self::$_instance == null) self::$_instance = new self();
          return self::$_instance;
     }

     public function getDb () 
     {
          if (self::$_db == null) self::$_db = new DataBase(DB_NAME);
          return self::$_db;
     }

     public function getEntity (string $entity) 
     {
          $entities = "\\App\\Entity\\".ucfirst($entity);
          return new $entities($this->getDb());
     }

}