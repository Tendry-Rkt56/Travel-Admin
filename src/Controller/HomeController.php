<?php

namespace App\Controller;

class HomeController extends Controller
{

     public function index ()
     {
          return $this->render('admin.index');
     }


}