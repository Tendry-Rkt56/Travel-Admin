<?php

namespace App\Controller;


class SecurityController extends Controller
{

     public function loginView ()
     {
          return $this->render('admin.login');
     }

     public function login (array $data = [])
     {
          $login = $this->manager->getEntity('user')->login($data);
          return $login ? $this->redirect('home') : $this->redirect('loginView'); 
     }

     public function logout ()
     {
          session_destroy();
          return $this->redirect('login');
     }

}