<?php

namespace App\Controller;


class UserController extends Controller
{

     public function index (array $data = [])
     {
          $count = $this->manager->getEntity('user')->getAll($data);
          $page = $data['page'] ?? 1;
          $limit = $data['limit'] ?? 10;
          $maxPages = ceil($count / $limit);
          $offset = ($page - 1) * $limit;          
          $users = $this->manager->getEntity('user')->all($limit, $offset, $data);
          $userLength = count($users);
          return $this->render('users.index', [
               'page' => $page,
               'count' => $count,
               'limit' => $limit,
               'maxPages' => $maxPages,
               'users' => $users,
               'data' => $data,
               'userLength' => $userLength,
          ]);
     }

     public function registration ()
     {
          return $this->render('users.register');
     }

     public function register (array $data = [], array $files = [])
     {
          $register = $this->manager->getEntity('user')->register($data, $files);
          return $register ? $this->redirect("users.index") : $this->redirect('users.register');
     }

     public function delete (int $id)
     {
          $delete = $this->manager->getEntity('user')->delete($id);
          if ($delete) return $this->redirect('users.index');
     }

     public function profil (int $id)
     {
          $user = $this->manager->getEntity('user')->find($id);
          return $this->render('users.profil', ['user' => $user]);
     }

     public function edit ()
     {
          return $this->render('users.edit', [
               // 'user' => $_SESSION['user'],
               'user' => $this->manager->getEntity('user')->find(8),
          ]);
     }

     public function update (array $data = [], array $files = [])
     {
          $update = $this->manager->getEntity('user')->update($_SESSION['user']->id, $data, $files);
          if ($update['status']) return $this->redirect("users.index");
          return $this->redirect("users.edit");
     }

}
