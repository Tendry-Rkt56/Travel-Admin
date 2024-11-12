<?php

namespace App\Controller;

class ErrorController extends Controller
{

     public function error()
     {
          return $this->render('error.error');
     }


}