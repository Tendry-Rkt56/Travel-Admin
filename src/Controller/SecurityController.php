<?php

namespace App\Controller;

use App\Manager;

class SecurityController extends Controller
{

     public function loginView ()
     {
          return $this->render('admin.login');
     }

     public function login (array $data = [])
     {
          $login = Manager::getManager()->getEntity('user')->login($data);
          return $login ? $this->redirect('home') : $this->redirect('loginView'); 
     }

     public function logout ()
     {
          session_destroy();
          return $this->redirect('login');
     }

}